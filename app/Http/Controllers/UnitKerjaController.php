<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\DB;


class UnitKerjaController extends Controller
{
    public function index(Request $request)
    {
        // union / penggabungan hasil dari database

        // $first = DB::table('dt_pegawais')->select('fullname as nama')->whereNot('divisi', 'SIPD')->whereNot('divisi', 'Petani Milenial');
        // $second = DB::table('pegawais')->select('nama');
        // $union = $second->union($first)->distinct()->get();
        // dd($union);

        // call view
        // $view = DB::table('view_pegawai_diskominfo')->select('*')->get();
        // dd($view);

        $unitkerja = UnitKerja::all();
        return view('home.master.unitKerja.index', ['unitkerjas'=> $unitkerja, 'title' => 'Unit Kerja']);
    }

    public function create()
    {
        return view('home.master.unitKerja.create', ['title' => 'Unit Kerja']);
    }

    public function store(Request $request)
    {
        UnitKerja::create($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('/unitkerja');
    }

    public function show($id)
    {
        $edit = UnitKerja::find($id);
        return view('home.master.unitKerja.edit',['data'=> $unitkerja, 'title' => 'Unit Kerja']);
    }

    public function edit($id)
    {
        $data = UnitKerja::find($id);
        return view('home.master.unitKerja.edit',['data'=> $data, 'title' => 'Unit Kerja']);
    }

    public function update(Request $request, $id)
    {
        $unitkerja = UnitKerja::find($id);
        $unitkerja->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/unitkerja')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(Bidang $bidang)
    {
        UnitKerja::destroy($bidang->id);
        return redirect('/unitkerja')->with('succes', 'Unit Kerja has been deleted');
    }

    // delete
    public function delete($id)
    {
        $unitkerja = UnitKerja::find($id);
        $unitkerja->delete();
        session()->flash('success', 'Unit Kerja Berhasil dihapus');
        
        return redirect('/unitkerja')->with('success', 'Unit Kerja berhasil dihapus');
    }
    
}
