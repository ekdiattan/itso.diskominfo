<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use App\Models\Pegawai;
use App\Models\Rekapitulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;


class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.kepegawaian.data.kehadiran.index', ['title' => 'Kehadiran']);
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
        try {
            $pegawais = Pegawai::select('nama', 'noPegawai', 'unitKerja')->orderBy('noPegawai', 'asc')->get()->toArray();
            $past = Carbon::now()->subDays(7)->format('l, d F Y');
            $today = Carbon::now();
            $previous = CarbonPeriod::create($past, $today);  
            foreach ($previous as $p){ // lakukan dengan tanggal yang berbeda selama 10 hari ke belakang
                if($p->format('l') !== 'Saturday' && $p->format('l') !== 'Sunday'){ // melakukan filter terhadap  hari sabtu dan minggu
                    $client = new Client();
                    $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
                    [
                        'query' => ['tanggal'=>$p->format('Y-m-d')],
                        'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
                    ]);
                    $body = $response->getBody();
                    $body_array = json_decode($body);

                    foreach($pegawais as $pegawai){
                        foreach($body_array as $result){
                            $post = (array)$result;
                            if($pegawai['nama'] == $post['nama']){
                                if($pegawai['nama'] == $post['nama'] && $pegawai['unitKerja'] == $post['unitkerja_nama']){
                                    Rekapitulasi::updateOrCreate([
                                        'nip' => $post['nip'],
                                        'nama' => $post['nama'],
                                        'unitkerja'=>$post['unitkerja_nama'],
                                        'tanggal' => $p->format('Y-m-d')
                                    ], [
                                        'masuk' => $post['masuk'],
                                        'pulang' => $post['pulang'],
                                        'terlambat' => $post['terlambat']
                                    ]);
                                } else {
                                    Rekapitulasi::updateOrCreate([
                                        'nip' => $post['nip'],
                                        'nama' => $post['nama'],
                                        'unitkerja'=>$pegawai['unitKerja'],
                                        'tanggal' => $p->format('Y-m-d')
                                    ], [
                                        'masuk' => $post['masuk'],
                                        'pulang' => $post['pulang'],
                                        'terlambat' => $post['terlambat']
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            session()->flash('success', 'Berhasil mengupdate data!');
            return redirect('/kepegawaian/kehadiran');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/kepegawaian/kehadiran');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/kepegawaian/kehadiran');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/kepegawaian/kehadiran');
        }
    }

    /**
     * Display the specified resource.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Request $request)
    {
        $client = new Client();
        $login = $client->request(
            'POST', 'https://groupware-api.digitalservice.id/auth/admin/login/', [
                'form_params' => [
                    'username' => 'yudiwardoyozz',
                    'password' => 'yudiwardoyozz', 
                ], [
                    'debug' => true
                ]
            ]
        );
        $result = json_decode($login->getBody()->getContents());
        $token = $result->auth_token;
        $page = 1;
        $maxPage = 2;
        while($page <= $maxPage){
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/info', [ // Data User Login

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/menu/user/list/', [ // Menu List

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/satuan-kerja/?limit=50', [ // Satuan Kerja

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/?page=1', [ // Detail absensi

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/is/checkout', [ // Mengecek apakah sudah checkin

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/is/checkin', [ // Mengecek apakah sudah checkout

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/report-user', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/attendance-user?month=5&year=2023', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=true&struktural=true&search=', [ // Ini untuk pegawai Aktif
            
            $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=false&struktural=&search=', [ // Pegawai nonaktif / alumni

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/?page_size=10&page=1&is_active=true&struktural=&search=', [ // Pegawai Non Asn
                
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/monthly-report/?search=&start_date=&end_date=&id_divisi=&category_export=true&divisi=b5c01ae4-8352-441f-9ce1-cf036893eae4&page_size=100', [ // Gatau apa tapi reporting kayanya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?satuan_kerja_id=57af1519-f286-406e-89da-da8dcc8d9bdd', [ // Detail untuk satuan kerja

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/user/0855fdc2-2209-47ae-9041-e3bddb371648/', [ // Detail untuk User

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/holiday-date/?year=2023&limit=100&page=1', [ // Hari libur nasional

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/dashboard/attendance-user?month=5&year=2023', [ // Rekapitulasi absen per bearer dari pengguna

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/monthly-report/?search=&start_date=2023-05-01&end_date=2023-05-31&id_divisi=&category_export=true&divisi=7f6b9830-78fd-4d09-bde0-fcde5e476db5&page_size=100', [ // Rekapitulasi progress laporan pegawai

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/export-pdf/report-by-user/download/34572763-c774-419d-b172-90be11cca711?start_date=2023-05-01&end_date=2023-05-31', [ // Export laporan by user id

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/export-excel/category/?divisi=7f6b9830-78fd-4d09-bde0-fcde5e476db5&search=&start_date=2023-05-01&end_date=2023-05-31', [ // Export laporan untuk divisi
                
            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/jabatan/?limit=10&page=1', [ // Daftar jabatan dengan detailnya

            // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/project/?limit=10&block=-&page=1', [ // Daftar proyek dalam API
                
            'headers' => [
            // 'headers' => [
                'Authorization' => 'Bearer '. $token,
            ]
            ]);
            $body = $response->getBody();
            $body_array = json_decode($body);
            dd($body_array);
        }
        $now = Carbon::now()->format('Y-m-d');
        if($request->search == null){
            $data_post = DB::table('rekapitulasis')->where('tanggal', '=', $now)->get();
        } else {
            $data_post = DB::table('rekapitulasis')->where('tanggal', '=', $now)->where('nama', 'ilike', '%'.$request->search.'%')->orwhere('unitkerja_nama', 'ilike', '%'.$request->search.'%')->get();
        }

        return view('home.kepegawaian.data.kehadiran.index', compact('data_post'), ['data_post' => $data_post, 'title' => 'Kehadiran', 'search' => $request->search]);
    }

    public function belum_absendet()
    {
        $now = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');

        $belum_absendet = DB::select("SELECT nama, unitkerja, terlambat FROM rekapitulasis WHERE (terlambat IS NOT NULL) AND nama NOT IN (SELECT nama FROM cutis WHERE '$now' BETWEEN tgl_mulai AND tgl_selesai) AND (terlambat > '0') AND (tanggal BETWEEN '$now' AND '$tomorrow')");

        $sum_sec = DB::table("rekapitulasis")->whereBetween('tanggal', array($now, $tomorrow))->sum('terlambat');

        return view('home.kepegawaian.data.kehadiran.terlambat_harian', ['belum_absendet'=>$belum_absendet, 'sum_sec'=>$sum_sec, 'todayTime'=>$todayTime, 'title' => 'Data Terlambat Harian']);
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
}
