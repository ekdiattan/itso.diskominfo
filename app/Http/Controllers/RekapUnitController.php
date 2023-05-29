<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use App\Models\Pegawai;
use App\Models\Libur;
use App\Models\Rekapitulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class RekapUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $liburs = Libur::select('tanggal')->get()->toArray();
        $parsedLibur = [];
        foreach($liburs as $libur){
            array_push($parsedLibur, $libur['tanggal']);
        }
        if($request->date == null){
            $start = Carbon::now()->subDays(7)->startOfWeek();
            $end = Carbon::now()->subDays(7)->endOfWeek();
            $periods = CarbonPeriod::create($start, $end)->toArray();
            $parsedPeriod = [];
            foreach($periods as $period){ // mengubah format dari Carbon menjadi Y-m-d
                array_push($parsedPeriod, $period->format('Y-m-d'));
            }

            $unit = DB::table('rekapitulasis')->select('unitkerja')->selectRaw('count(DISTINCT nama) AS sum_nama')->selectRaw('SUM(terlambat) AS sum_score')->whereIn('tanggal', $parsedPeriod)->whereNotIn('tanggal', $parsedLibur)->where('terlambat', '>', '0')->orderByRaw('sum_score DESC')->groupBy('unitkerja')->get();

        } else {
            $start = Carbon::parse($request->date)->startOfWeek();
            $end = Carbon::parse($request->date)->endOfWeek();
            $periods = CarbonPeriod::create($start, $end)->toArray();
            $parsedPeriod = [];
            foreach($periods as $period){
                array_push($parsedPeriod, $period->format('Y-m-d'));
            }

            $unit = DB::table('rekapitulasis')->select('unitkerja')->selectRaw('count(DISTINCT nama) AS sum_nama')->selectRaw('SUM(terlambat) AS sum_score')->whereIn('tanggal', $parsedPeriod)->whereNotIn('tanggal', $parsedLibur)->where('terlambat', '>', '0')->orderByRaw('sum_score DESC')->groupBy('unitkerja')->get();
        }
    
        return view('home.kepegawaian.data.rekapitulasi.masuk.terlambat_unit', ['unit'=>$unit, 'title' => 'Rekapitulasi Terlambat Masuk Unit', 'date' => $start->format('Y-m-d')]);
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
            return redirect('/rekap/terlambat-masuk-unit');
        } catch (ServerException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk-unit');
        } catch (ClientException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk-unit');
        } catch (BadResponseException $e) {
            session()->flash('error', 'Terjadi masalah pada API KMOB, silakan coba kembali');
            return redirect('/rekap/terlambat-masuk-unit');
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
