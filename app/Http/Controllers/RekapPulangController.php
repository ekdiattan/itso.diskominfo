<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use App\Models\RekapPulang;
use App\Models\Pegawai;
use App\Models\Rekapitulasi;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class RekapPulangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->tanggal == null){ // without input date
            $tgl = Carbon::now()->format('Y-m-d');
            $monday = Carbon::now()->startOfWeek()->format('Y-m-d');
            $tuesday = Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d');
            $wednesday = Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d');
            $thursday = Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d');
            $friday = Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d');
            
            $days = Carbon::create($monday);
            
            $namas = DB::table('pegawais')->select('nama', 'unitKerja')->distinct('nama')->get();
            
            
            $pulangs = collect(); // initialize container
            // get sum of terlambat start by start of this week
            foreach($namas as $nama){
                $pulangs->push([
                    'nama' => $nama->nama,
                    'unitkerja_nama' => $nama->unitKerja,
                    'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $monday)->orderBy('nama', 'desc')->count(),
                    'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $tuesday)->orderBy('nama', 'desc')->count(),
                    'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $wednesday)->orderBy('nama', 'desc')->count(),
                    'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $thursday)->orderBy('nama', 'desc')->count(),
                    'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $friday)->orderBy('nama', 'desc')->count()
                ]); // totalnya masih ada kesalahan
            }
        } else { // with input date
            $days = Carbon::create($request->tanggal);
            $tgl = Carbon::parse($request->tanggal)->format('Y-m-d');
            $first = Carbon::parse($request->tanggal)->format('Y-m-d');
            $second = Carbon::parse($request->tanggal)->addDays(1)->format('Y-m-d');
            $third = Carbon::parse($request->tanggal)->addDays(2)->format('Y-m-d');
            $fourth = Carbon::parse($request->tanggal)->addDays(3)->format('Y-m-d');
            $fifth = Carbon::parse($request->tanggal)->addDays(4)->format('Y-m-d');
            
            $namas = DB::table('pegawais')->select('nama', 'unitKerja')->distinct('nama')->get();
            
            $pulangs = collect(); // initialize container
            // get sum of terlambat start by start of this week
            foreach($namas as $nama){
                $pulangs->push([
                    'nama' => $nama->nama,
                    'unitkerja_nama' => $nama->unitKerja,
                    'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $first)->orderBy('nama', 'desc')->count(),
                    'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $second)->orderBy('nama', 'desc')->count(),
                    'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $third)->orderBy('nama', 'desc')->count(),
                    'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $fourth)->orderBy('nama', 'desc')->count(),
                    'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('pulang', '=', '00:00:00')->where('tanggal', '=', $fifth)->orderBy('nama', 'desc')->count()
                ]); // totalnya masih ada kesalahan
            }
        }  

        return view('home.kepegawaian.data.rekapitulasi.pulang.tidak_absen', ['title' => 'Rekapitulasi Tidak Absen Pulang Pegawai', 'pulangs' => $pulangs, 'date' => $tgl, 'days' => $days]);
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
    public function store(Request $request)
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
            return redirect('/rekap/tidak-absen-pulang');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/tidak-absen-pulang');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/tidak-absen-pulang');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/tidak-absen-pulang');
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
