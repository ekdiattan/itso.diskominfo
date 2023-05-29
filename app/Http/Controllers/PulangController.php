<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pulang;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

use PDF;

class PulangController extends Controller
{
    public function store()
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $todayDate = Carbon::now()->format('Y-m-d');
            $now = Carbon::now();
            $client = new Client();
            $response = $client->request (
                'GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                ['query' => ['tanggal'=>$todayDate], 'auth' => ['diskominfo_presensi','diskominfo_presensi12345']]
            );
                $body = $response->getBody();
                $body_array = json_decode($body);

                DB::table('pulangs')->truncate();
                
                foreach ($body_array as $post){
                    $post = (array)$post;
                    
                    Pulang::updateOrCreate(
                        [
                            'nip' => $post['nip'],
                            'nama' => $post['nama'],
                            'unitkerja_nama' => $post['unitkerja_nama'],
                            'tanggal' => $todayDate,
                            'pulang' => $post['pulang'], 'update' => $now
                        ],
                    );
            }
            session()->flash('success', 'Berhasil mengupdate data!');
            return redirect('/absen-pulang');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-pulang');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-pulang');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-pulang');
        }
    }

    function index()
    {   
        $now = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');
        $last_update = DB::select("SELECT DISTINCT update from pulangs");
        
        $absen_pulang = DB::select("SELECT nama, unitkerja_nama FROM pulangs WHERE (pulang = '00:00:00') AND nama NOT IN (SELECT nama FROM cutis WHERE '$now' BETWEEN tgl_mulai AND tgl_selesai) AND nama NOT IN (SELECT nama FROM pengecualian_pegawais WHERE '$now' BETWEEN mulai AND selesai) AND (tanggal BETWEEN '$now' AND '$tomorrow') ORDER BY nama ASC");

        foreach($last_update as $time){
            $update = Carbon::parse($time->update)->format('H:i:s');
        } 

        $absen = array('Assalamualaikum Warohmatullahi Wabarokatuh', 'Selamat sore Bapak/Ibu', 'Disampaikan daftar pegawai yang belum melakukan presensi untuk skema pulang kerja sampai pukul', $update,' WIB berikut :%0A');
        foreach($absen_pulang as $masuk){
            array_push($absen, $masuk->nama);
        }
        array_push($absen, '%0ATerima kasih 🙏😊');
        array_push($absen, 'Salam,');
        array_push($absen, 'Tim Sekretariat Diskominfo');
        array_push($absen, '%23ExcellentService');
        array_push($absen, '%23DiskominfoJuara');
        array_push($absen, '%23JabarJuaraLahirBatin');
        $strAbsenPulang = implode('%0A', $absen);
        // %0A = New Line
        // %20 = Space
        // %23 = hastag

        return view('home.kepegawaian.data.absen.pulang', ['absen_pulang'=>$absen_pulang, 'strAbsen' => $strAbsenPulang, 'todayTime'=>$todayTime, 'last_update'=>$last_update, 'title' => 'Belum Absen Pulang']);
    }

    public function export(){
        $now = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');

        $last_update = DB::select("SELECT DISTINCT update from pulangs");
        
        $absen_pulang = DB::select("SELECT nama, unitkerja_nama FROM pulangs WHERE pulang = '00:00:00' AND tanggal BETWEEN '$now' AND '$tomorrow' ORDER BY nama ASC");

        $pdf = PDF::loadView('home.kepegawaian.data.absen.pulang_pdf', ['absen_pulang'=>$absen_pulang, 'todayTime'=>$todayTime, 'last_update'=>$last_update]);

        return $pdf->download('Pulang-'.$todayTime.'.pdf');
    }
}
