<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Masuk;
use App\Models\PengecualianPegawai;
use App\Models\Cuti;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

use PDF;
use Telegram;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');

        $absen_masuk = DB::select("SELECT nama FROM masuks WHERE masuk = '00:00:00' AND nama NOT IN (SELECT nama FROM cutis WHERE '$now' BETWEEN tgl_mulai AND tgl_selesai) AND nama NOT IN (SELECT nama FROM pengecualian_pegawais WHERE '$now' BETWEEN mulai AND selesai) AND tanggal='$now' ORDER BY nama ASC");
        	    
        $last_update = DB::select("SELECT update FROM masuks ORDER BY update DESC LIMIT 1");
        $update = Carbon::parse($last_update[0]->update)->format('H:i:s');
        $absen = array('Assalamualaikum Warohmatullahi Wabarokatuh Bapak/Ibu..', 'Semangat pagi', 'Disampaikan daftar pegawai yang belum melakukan presensi untuk skema masuk kerja sampai pukul', $update,' WIB berikut :%0A');
        foreach($absen_masuk as $masuk){
            array_push($absen, $masuk->nama);
        }
        array_push($absen, '%0ATerima kasih 🙏😊');
        array_push($absen, 'Salam,');
        array_push($absen, 'Tim Sekretariat Diskominfo');
        array_push($absen, '%23ExcellentService');
        array_push($absen, '%23DiskominfoJuara');
        array_push($absen, '%23JabarJuaraLahirBatin');
        $strAbsenMasuk = implode('%0A', $absen);
        // %0A = New Line
        // %20 = Space

        return view('home.kepegawaian.data.absen.masuk', ['absen_masuk'=>$absen_masuk, 'strAbsen' => $strAbsenMasuk, 'now'=>$now, 'todayTime'=>$todayTime, 'last_update'=>$last_update, 'title' => 'Belum Absen Masuk']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store()
    {
        date_default_timezone_set('Asia/Jakarta');
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $now = Carbon::now();
            $client = new Client();
            $response = $client->request(
                'GET',
                'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                [
                    'query' => ['tanggal' => $todayDate],
                    'auth' => ['diskominfo_presensi', 'diskominfo_presensi12345']
                    ]
                );
                
                $body = $response->getBody();
                $body_array = json_decode($body);
                
                DB::table('masuks')->truncate();
                foreach ($body_array as $post) {
                    $post = (array)$post;
                    Masuk::updateOrCreate(
                        [
                            'nip' => $post['nip'],
                            'nama' => $post['nama'],
                            'unitkerja_nama' => $post['unitkerja_nama'],
                            'tanggal' => $todayDate,
                            'masuk' => $post['masuk'],
                            'terlambat' => $post['terlambat'],
                            'update' => $now
                        ],
                    );
                }
            session()->flash('success', 'Berhasil Mengupdate Data!');
            return redirect('/absen-masuk');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-masuk');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-masuk');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/absen-masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export(){
        $now = Carbon::now()->format('Y-m-d');

        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');

        $absen_masuk = DB::select("SELECT nama FROM masuks WHERE masuk = '00:00:00' AND nama NOT IN (SELECT nama FROM cutis WHERE '$now' BETWEEN tgl_mulai AND tgl_selesai) AND tanggal='$now' ORDER BY nama ASC"); 
	    $last_update = DB::select("SELECT update FROM masuks ORDER BY update DESC LIMIT 1");

        $pdf = PDF::loadView('home.kepegawaian.data.absen.masuk_pdf', ['absen_masuk'=>$absen_masuk, 'now'=>$now, 'todayTime'=>$todayTime, 'last_update'=>$last_update]);

        return $pdf->download('Masuk-'.$todayTime.'.pdf');
    }
}
