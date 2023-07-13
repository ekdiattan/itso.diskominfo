<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use App\Models\Pegawai;
use App\Models\DtKehadiran;
use App\Models\Libur;
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
        $users = [
            [
                'username' => "yudiwardoyozz",
                'password' => "yudiwardoyozz"
            ] , [
                'username' => "kenisya09",
                'password' => "kenisya09"
            ]
        ];
        foreach($users as $user){
            $client = new Client();
            $login = $client->request(
                'POST', 'https://groupware-api.digitalservice.id/auth/admin/login/', [
                    'form_params' => [
                        'username' => $user['username'],
                        'password' => $user['password'], 
                    ]
                ]
            );
            $result = json_decode($login->getBody()->getContents());
            $token = $result->auth_token;
    
            // pegawai Update pegawai and its pendidikans
            // $page = 1;
            // $maxPage = 1;
            // while($page <= $maxPage){
                // $today = Carbon::now()->format('Y-m-d');
                // $response = $client->request ('GET', 'https://groupware-api.digitalservice.id/attendance/?limit=200&pageSize=200&date='.$today, [
                //     'headers' => [
                //         'Authorization' => 'Bearer '. $token,
                //         ]
                //     ]);
                // $body = json_decode($response->getBody());
                // foreach($body->results as $result){
                //     DtKehadiran::upsert([
                //         "_id" => $result->_id,
                //         "startDate" => $result->startDate,
                //         "endDate" => $result->endDate,
                //         "officeHours" => isset($result->officeHours) ? $result->officeHours : '',
                //         "location" => $result->location,
                //         "message" => $result->message,
                //         "note" => isset($result->note) ? $result->note : '',
                //         "mood" => $result->mood,
                //         "fullname" => $result->fullname,
                //         "email" => $result->email,
                //         "username" => $result->username,
                //         "divisi" => $result->divisi,
                //         "jabatan" => $result->jabatan,
                //         "date" => $today,
                //     ], [
                //         "_id",
                //     ], [
                //         "startDate",
                //         "endDate",
                //         "officeHours",
                //         "location",
                //         "message",
                //         "note",
                //         "mood",
                //         "fullname",
                //         "email",
                //         "username",
                //         "divisi",
                //         "jabatan",
                //     ]);
                // }
            // }
        }
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
