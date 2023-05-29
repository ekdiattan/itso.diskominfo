<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $kategori = DB::table('kategoris')->where('kategori', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $kategori = DB::table('kategoris')->where('kategori', true)->paginate(10);
        }
        // $kategori = Kategori::paginate(10);

        return view('home.master.kategori.index', ['kategoris'=> $kategori, 'title' => 'Kategori']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.master.kategori.create', ['title' => 'Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kategori::create($request->all());
        return redirect('/kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit= Kategori::find($id);
        $kategori= Kategori::all();

        return view('home.master.kategori.edit',['edit'=> $edit, 'kategori'=>$kategori, 'title' => 'Kategori']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate data!');

        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        return redirect('/kategori')->with('succes', 'Laporan has been deleted');
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        // $id->accepts(session());
        session()->flash('success', 'Kategori Berhasil dihapus');
        
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}