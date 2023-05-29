<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use App\Models\Rekapitulasi;
use App\Models\Pegawai;
use App\Models\PengecualianPegawai;
use App\Models\Libur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class RekapMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $liburs = Libur::select('tanggal')->get()->toArray();
        $pengecualian = PengecualianPegawai::select('nip', 'mulai', 'selesai')->get();
        $parsedLibur = [];
        foreach($liburs as $libur){ // mengubah format tanggal menjadi Y-m-d
            array_push($parsedLibur, $libur['tanggal']);
        }

        if($request->tanggal == null){ // without input date
            $tgl = Carbon::now()->startOfWeek()->format('Y-m-d');
            $monday = Carbon::now()->startOfWeek()->format('Y-m-d');
            $tuesday = Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d');
            $wednesday = Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d');
            $thursday = Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d');
            $friday = Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d');
            
            $days = Carbon::create($monday);
            
            $x = Carbon::now()->subDays(7)->format('Y M d');
          
            $namas = DB::table('pegawais')->select('nama', 'unitKerja', 'noPegawai')->distinct('nama')->get();
            
            $terlambats = collect(); // initialize container
            // get sum of terlambat start by start of this week
            if(sizeof($pengecualian) == 0){
                foreach($namas as $nama){
                    $terlambats->push([
                        'nama' => $nama->nama,
                        'unitkerja' => $nama->unitKerja,
                        'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $monday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $tuesday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $wednesday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $thursday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $friday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat')
                    ]);
                }
            } else {
                foreach($pengecualian as $except){
                    foreach($namas as $nama){
                        // if($except->nip != $nama->noPegawai && ($except->mulai != $monday || $except->mulai != $tuesday || $except->mulai != $wednesday || $except->mulai != $thursday || $except->mulai != $friday)){
                        if($except->nip != $nama->noPegawai && ($except->mulai <= $monday && $monday <= $except->selesai) && ($except->mulai <= $tuesday && $tuesday <= $except->selesai) && ($except->mulai <= $wednesday && $wednesday <= $except->selesai) && ($except->mulai <= $thursday && $thursday <= $except->selesai) && ($except->mulai <= $friday && $friday <= $except->selesai) ){
                            $terlambats->push([
                                'nama' => $nama->nama,
                                'unitkerja' => $nama->unitKerja,
                                'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $monday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $tuesday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $wednesday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $thursday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $friday)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat')
                            ]); 
                        }
                    }
                }
            }
        } else { // with input date
            $parsedDate = Carbon::create($request->tanggal);
            $tgl = $parsedDate->format('d-m-Y');
            $days = Carbon::create($tgl);
            $first = Carbon::create($request->tanggal)->format('Y-m-d');
            $second = Carbon::create($request->tanggal)->addDays(1)->format('Y-m-d');
            $third = Carbon::create($request->tanggal)->addDays(2)->format('Y-m-d');
            $fourth = Carbon::create($request->tanggal)->addDays(3)->format('Y-m-d');
            $fifth = Carbon::create($request->tanggal)->addDays(4)->format('Y-m-d');

            $namas = DB::table('pegawais')->select('nama', 'unitKerja', 'noPegawai')->distinct('nama')->get();
            $terlambats = collect(); // initialize container
            // get sum of terlambat per day start by request->tanggal
            if(sizeof($pengecualian) == 0){
                foreach($namas as $nama){
                    $terlambats->push([
                        'nama' => $nama->nama,
                        'unitkerja' => $nama->unitKerja,
                        'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $first)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $second)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $third)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $fourth)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                        'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $fifth)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat')
                    ]);
                }
            } else {
                foreach($pengecualian as $except){
                    foreach($namas as $nama){
                        if($except->nip != $nama->noPegawai && ($except->mulai <= $first || $first <= $except->selesai) && ($except->mulai <= $second || $second <= $except->selesai) && ($except->mulai <= $third || $third <= $except->selesai) && ($except->mulai <= $fourth || $fourth <= $except->selesai) && ($except->mulai <= $fifth || $fifth <= $except->selesai)){
                            $terlambats->push([
                                'nama' => $nama->nama,
                                'unitkerja' => $nama->unitKerja,
                                'monday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $first)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'tuesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $second)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'wednesday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $third)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'thursday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $fourth)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat'),
                                'friday' => DB::table('rekapitulasis')->where('nama', '=', $nama->nama)->where('unitkerja', '=', $nama->unitKerja)->where('tanggal', '=', $fifth)->whereNotIn('tanggal', $parsedLibur)->groupBy('terlambat', 'nama', 'tanggal')->sum('terlambat')
                            ]); 
                        }
                    }
                }
            }
        }
        return view('home.kepegawaian.data.rekapitulasi.index', ['data_terlambat'=>$terlambats, 'tgl'=> $tgl, 'days' => $days, 'title' => 'Rekapitulasi Masuk Pegawai', 'date' => $request->tanggal]);
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
            return redirect('/rekap/terlambat-masuk');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk');
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
}
