<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriUsia;

class KategoriUsiaController extends Controller
{
    public function index(Request $request){
        $usias = KategoriUsia::all();
        return view('home.master.kategoriUsia.index', ['title' => "Kategori Usia", 'usias' => $usias]);
    }

    public function store(Request $request){
        KategoriUsia::create($request->all());
        return redirect('/usia/');
    }

    public function edit($id){
        $kategori = KategoriUsia::find($id);
        return view('home.master.kategoriUsia.edit', ['title' => "Kategori Usia", 'kategori' => $kategori]);
    }

    public function update(Request $request, $id){
        $kategori = KategoriUsia::find($id);
        $kategori->update([
            'kategori' => $request->kategori,
            'dari' => $request->dari,
            'hingga' => $request->hingga
        ]);

        return redirect('/usia/');
    }

    public function delete($id){
        $kategori = KategoriUsia::find($id);
        $kategori->delete();

        return redirect('/usia/')->with('success', 'Data berhasil dihapus');
    }
}
