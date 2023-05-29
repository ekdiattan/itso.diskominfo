<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Libur;
use App\Models\Pegawai;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class CutiController extends Controller
{
    public function store()
    {
        try {
            $todayYear = Carbon::now()->format('Y');
            $todayMonth = Carbon::now()->format('m');
        
            $now = Carbon::now();
        
            $startMonth = Carbon::now();
            $pastMonth = $startMonth->subMonths(1);
        
            $periode = CarbonPeriod::create($pastMonth, $startMonth);
        
            foreach ($periode as $p) {
                $client = new Client();
                $response = $client->request(
                    'GET',
                    'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/cuti-bulanan',
                    [
                        'query' => ['tahun' => $todayYear, 'bulan' => $p->format('m')],
                        'auth' => ['diskominfo_presensi', 'diskominfo_presensi12345']
                    ]
                );
                $cuti = $response->getBody();
                $cuti_array = json_decode($cuti);
                foreach ($cuti_array as $post) {
                    $post = (array)$post;
        
                    Cuti::updateOrCreate(
                        [
                            'nama' => $post['nama'],
                            'tgl_mulai' => $post['tgl_mulai']
                        ], [
                            'njab' => $post['njab'],
                            'unitkerja_nama' => $post['unitkerja_nama'],
                            'jenis_cuti' => $post['jenis_cuti'],
                            'tgl_selesai' => $post['tgl_selesai'],
                            'uraian' => $post['uraian'],
                            'tgl_pengajuan' => $post['tgl_pengajuan'],
                            'atasan' => $post['atasan'],
                            'ket_proses' => $post['ket_proses']
                        ]
                    );
                }
            }
        
            session()->flash('success', 'Berhasil mengupdate data');
            return redirect('/cuti');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/cuti');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/cuti');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/cuti');
        }
    }

    function show()
    {
        $namas = Pegawai::select('nama', 'unitKerja')->get()->toArray();
        $arrayNama = array();
        foreach($namas as $nama){
            array_push($arrayNama, $nama['nama']);
        }
        $data_cuti = Cuti::All()->whereIn('nama', $arrayNama)->sortByDesc('tgl_pengajuan')->values();
        return view('home.kepegawaian.data.cuti.index', compact('data_cuti'), ['title' => 'Cuti']);
    }

    function this_month(){
        $now = Carbon::now();
        $data_cuti = DB::select("SELECT * from cutis where '$now' between tgl_mulai and tgl_selesai");
        return view('home.kepegawaian.data.cuti.this_month.index', compact('data_cuti'), ['title' => 'Cuti']);
    }

    public function jumlah(){ // TOTO : Filter with holiday, the Holiday date wouldn't counted as cuti
        $year = date("Y"); // define this year value
        $namas = Pegawai::select('nama', 'unitKerja')->get();
        $result = collect(); // initialize collection to store sum data

        $liburs = Libur::all();
        $holidays = [];
        foreach($liburs as $libur){
            array_push($holidays, Carbon::create($libur->tanggal));
        }

        
        foreach($namas as $nama){
            // disini kita akan menghitung jumlah hari dari cuti yang dilakukan oleh pegawai
            $cutis = Cuti::select('tgl_mulai', 'tgl_selesai')->where('nama', $nama->nama)->where('unitkerja_nama', $nama->unitKerja)->where('jenis_cuti', 'TAHUNAN')->get();

            $total = 0; // initialize variable to hold total cutis
            $totalbfr = 0; // initialize variable to hold total cutis
            $totalbfrbfr = 0; // initialize variable to hold total cutis
            foreach($cutis as $cuti){ // Todo : Except by holiday Date
                if(Carbon::parse($cuti->tgl_mulai)->format('Y') == $year && Carbon::parse($cuti->tgl_selesai)->format('Y') == $year){ // thisYear
                    $total += Carbon::parse($cuti->tgl_mulai)->DiffInDaysFiltered(function(Carbon $date) use ($holidays){
                        return (!$date->isWeekend() && !in_array($date, $holidays));
                    }, (Carbon::parse($cuti->tgl_selesai)->addDays(1))); // increment value of total by different of cuti except saturday and sunday
                } else if (Carbon::parse($cuti->tgl_mulai)->format('Y') == $year-1 && Carbon::parse($cuti->tgl_selesai)->format('Y') == $year-1){ // thisYear-1
                    $totalbfr += Carbon::parse($cuti->tgl_mulai)->DiffInDaysFiltered(function(Carbon $date)  use ($holidays){
                        return (!$date->isWeekend() && !in_array($date, $holidays));
                    }, (Carbon::parse($cuti->tgl_selesai)->addDays(1))); // increment value of total by different of cuti except saturday and sunday
                } else if (Carbon::parse($cuti->tgl_mulai)->format('Y') == $year-2 && Carbon::parse($cuti->tgl_selesai)->format('Y') == $year-2){ // thisYear-2
                    $totalbfrbfr += Carbon::parse($cuti->tgl_mulai)->DiffInDaysFiltered(function(Carbon $date) use ($holidays){
                        return (!$date->isWeekend() && !in_array($date, $holidays));
                    }, (Carbon::parse($cuti->tgl_selesai)->addDays(1))); // increment value of total by different of cuti except saturday and sunday
                }
                // INI BELUM BISA NGEHANDLE CUTI YANG START DAN END DI TAHUN YANG BERBEDA 
            }
            $result->push(
                [
                'name' => $nama->nama,
                'unit' => $nama->unitKerja,
                'year' => $total,
                'yearbfr' => $totalbfr,
                'yearbfrbfr' => $totalbfrbfr
            ]);
        }
        return view('home.kepegawaian.data.cuti.jumlah_cuti', ['title' => 'Jumlah Cuti', 'cutis' => $result, 'year' => $year]);
    }
}

