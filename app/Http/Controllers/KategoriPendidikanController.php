<?php

namespace App\Http\Controllers;

use App\Models\KategoriPendidikan;
use App\Models\Pegawai;
use App\Models\DtPendidikan;
use Illuminate\Http\Request;

class KategoriPendidikanController extends Controller
{
    public function index()
    {
        $data = DtPendidikan::all()->unique('majors');
        $katpen = KategoriPendidikan::all();
        // dd($data);
        return view('home.master.kategoriPendidikan.index', [ 'data' => $data,'katpen' => $katpen,'title' => 'Kategori Pendidikan']);
    }

    public function store(Request $request)
    {
        KategoriPendidikan::create($request->all());
        return redirect('/kategori-pendidikan');
    }


    public function edit($id)
    {
        $edit = KategoriPendidikan::find($id);
        // dd($edit);
        $data = DtPendidikan::all()->unique('majors');
        return view('home.master.kategoriPendidikan.edit', ['data' => $data,'edit' => $edit,'title' => 'Mapping Dashboard']);
    }

    public function update(Request $request, $id)
    {
        $edit = KategoriPendidikan::find($id);
        $edit->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil Mengupdate data!');
        return redirect('/kategori-pendidikan')->with('success', 'Berhasil Mengupdate Data');
    }

    public function delete($id)
    {
        $edit = KategoriPendidikan::find($id);
        $edit->delete();
        session()->flash('success', 'Berhasil dihapus');
        
        return redirect('/kategori-pendidikan')->with('success', 'Berhasil dihapus');
    }
}
