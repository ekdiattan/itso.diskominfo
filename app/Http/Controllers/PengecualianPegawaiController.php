<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;;
use App\Models\PengecualianPegawai;
use Carbon\Carbon;

class PengecualianPegawaiController extends Controller
{
    
    public function index(){
        // need to make exception model
        $pegawai = Pegawai::select('noPegawai', 'nama')->orderBy('nama', 'asc')->get();
        $pengecualian = PengecualianPegawai::select('id', 'nip', 'nama', 'unitkerja', 'keterangan', 'mulai', 'selesai')->orderBy('created_at', 'desc')->get();
        return view('home.master.exceptionPegawai.index', ['title' => 'Pengecualian Pegawai', 'pegawais' => $pegawai, 'pengecualians' => $pengecualian]);
    }

    public function insert(Request $request){
        $pegawais = Pegawai::all();
        foreach($pegawais as $pegawai){ // get NIP of pegawai
            if($pegawai->noPegawai != $request->nip){
                continue;
            } else {
                $found = $pegawai;
            }
        }
        
        $mulai = Carbon::parse($request->mulai)->format('Y-m-d');
        $selesai = Carbon::parse($request->selesai)->format('Y-m-d');
        PengecualianPegawai::create([
            'nip' => $found->noPegawai,
            'nama' => $found->nama,
            'unitkerja' => $found->unitKerja,
            'keterangan' => $request->keterangan,
            'mulai' => $mulai,
            'selesai' => $selesai
        ]);
        return redirect('/pengecualian');
    }

    public function edit($id){
        $pengecualian = PengecualianPegawai::find($id);
        return view('home.master.exceptionPegawai.edit', ['title' => 'Pengecualian Pegawai','pengecualian' => $pengecualian]);
    }

    public function update(Request $request, $id){
        $pengecualian = PengecualianPegawai::find($id);
        $pengecualian->update([
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/pengecualian');
    }
    
    public function delete($id){
        $pengecualian = PengecualianPegawai::find($id);
        $pengecualian->delete();
        
        return redirect('/pengecualian');
    }
}
