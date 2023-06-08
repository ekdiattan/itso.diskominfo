<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\DtPegawai;
use App\Models\Bidang;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // INI UNTUK MELAKUKAN KOMPARASI DATA
        // $todayDate = Carbon::now()->format('Y-m-d');
        // $client = new Client();
        // $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
        // [
        //     'query' => ['tanggal'=>$todayDate],
        //     'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
        // ]);
        // $body = $response->getBody();
        // $body_array = json_decode($body);
        
        
        // $dataApi = [];
        // foreach($body_array as $result){
        //     array_push($dataApi, (array)$result);
        // }
        
        // $pegawais = Pegawai::select('nama', 'noPegawai', 'unitKerja')->orderBy('noPegawai', 'asc')->get()->toArray();
        
        // $diff = [];
        // if(sizeof($pegawais) >= sizeof($dataApi)){
        //     foreach($pegawais as $pegawai){
        //         foreach($dataApi as $data){
        //             if($pegawai['nama'] != $data['nama'] && $pegawai['noPegawai'] != $data)
        //         }
        //     }
        // } else {
        //     foreach($dataApi as $data){
        //         foreach($pegawais as $pegawai){

        //         }
        //     }
        // }
        // $data = DB::table('pegawais')->orderBy('noPegawai', 'asc')->get();
        // $nonpns = DB::table('dt_pegawais')->get();
        $data = Pegawai::all();
        $nonpns = DtPegawai::where('is_active', 'true')->whereNot('jabatan', 'PNS')->get();
        return view('home.kepegawaian.data.master_pegawai.index', [ 'data' => $data, 'nonpns' => $nonpns,'title' => 'Pegawai', 'search' => $request->search]);
    }

    public function create(Request $request)
    {
        $bidang = Bidang::all();
        return view('home.kepegawaian.data.master_pegawai.create', ['bidangs' => $bidang, 'title' => 'Pegawai']);
    }

    public function store(Request $request)
    {
        Pegawai::create($request->all());

        $request->accepts('session');

        session()->flash('success', 'Berhasil menambahkan data!');
 
        return view('home.kepegawaian.data.master_pegawai.create', ['title' => 'Pegawai']);
    }

    public function update()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $client = new Client();
        $response = $client->request ('GET', 'https://siap.jabarprov.go.id/integrasi/api/v1/kmob/presensi-harian',
        [
            'query' => ['tanggal'=>$todayDate],
            'auth' => ['diskominfo_presensi','diskominfo_presensi12345']
        ]);
        $body = $response->getBody();
        $body_array = json_decode($body);

        foreach ($body_array as $post){
            $post = (array)$post;

            Pegawai::upsert([
                    'nama' => $post['nama'],
                    'tempatLahir' => null,
                    'tanggalLahir' => null,
                    'noPegawai' => $post['nip'],
                    'unitKerja' => $post['unitkerja_nama'],
                    'golonganPangkat' => null,
                    'tmtGolongan' => null,
                    'eselon' => null,
                    'namaJabatan' => null,
                    'tmtJabatan' => null,
                    'statusPegawai' => null,
                    'tmtPegawai' => null,
                    'masaKerjaTahun' => null,
                    'masaKerjaBulan' => null,
                    'jenisKelamin' => null,
                    'agama' => null,
                    'perkawinan' => null,
                    'pendidikanAwal' => null,
                    'jurusanPendidikanAwal' => null,
                    'pendidikanAkhir' => null,
                    'jurusanPendidikanAkhir' => null,
                    'noAkses' => null,
                    'noNpwp' => null,
                    'nik' => null,
                    'alamatRumah' => null,
                    'telp' => null,
                    'hp' => null,
                    'email' => null,
                    'kedudukanPegawai' => null
                ], ['noPegawai'], ['nama', 'unitKerja']);
        }
        return redirect()->action([PegawaiController::class, 'index']);
    }

    public function edit($id)
    {
        $edit = Pegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.editpns', [ 'edit' => $edit, 'title' => 'Pegawai']);
    }

    public function upd(Request $request, $id)
    {
        $edit = Pegawai::find($id);
        $edit->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/detail-pegawai/'.$id)->with('success', 'Berhasil Mengupdate Data');
    }

    public function delete($id)
    {
        $user = Pegawai::find($id);
        $user->delete();

        return back()->with('successDelete', 'Data has been deleted!');
    }

// PNS
    public function pnsindex(Request $request)
    {
        
        if($request->search == null){
            $data = DB::table('pegawais')->orderBy('noPegawai', 'asc')->get();
        }else{
            $data = DB::table('pegawais')->where('nama', 'ilike', '%'.$request->search.'%')->orwhere('unitKerja', 'ilike', '%'.$request->search.'%')->get();
        }
        return view('home.kepegawaian.data.master_pegawai.pns', compact('data'), [ 'data' => $data, 'title' => 'Pegawai', 'search' => $request->search]);
    }
//  Detail PNS
     public function show($id){
        $pegawai= Pegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.show',['pegawai'=> $pegawai, 'title' => 'Detail Pegawai']);
    }

// NONPNS
    public function nonpns(Request $request)
    {
        $data = DtPegawai::whereNot('jabatan', 'PNS')->where('is_active', 'true')->get();
        foreach($data as $result){
            $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
            $result->join_date = Carbon::parse($result->join_date)->translatedFormat('d F Y');
        }
        return view('home.kepegawaian.data.master_pegawai.nonpns', [ 'data' => $data, 'title' => 'Pegawai']);
    }

//  Detail NON-PNS
    public function detail($id){
        $nonpns= DtPegawai::find($id);
        // $nonpns->join_date = Carbon::parse($nonpns->join_date)->format('Y-m-d\TH:i:s');
        $nonpns->join_date = Carbon::parse($nonpns->join_date)->translatedFormat('d F Y');
        $nonpns->birth_date = Carbon::parse($nonpns->birth_date)->translatedFormat('d F Y');
        return view('home.kepegawaian.data.master_pegawai.detail',['nonpns'=> $nonpns, 'title' => 'Detail Pegawai']);
    }


    public function editnon($id)
    {
        $edit = DtPegawai::find($id);
        return view('home.kepegawaian.data.master_pegawai.editnonpns', [ 'edit' => $edit, 'title' => 'Pegawai']);
    }

    public function updnon(Request $request, $id)
    {
        $edit = DtPegawai::find($id);
        $edit->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/detail-nonpns/'.$id)->with('success', 'Berhasil Mengupdate Data');
    }


// Tidak Aktif
    public function nonaktifindex(Request $request)
    {
        $data = DtPegawai::where('is_active', 'false')->get();
        // dd($data);
        foreach($data as $result){
            $result->birth_date = Carbon::parse($result->birth_date)->translatedFormat('d F Y');
        }
        return view('home.kepegawaian.data.master_pegawai.tidakaktif', [ 'data' => $data, 'title' => 'Pegawai Tidak Aktif', 'search' => $request->search]);
    }

   

}