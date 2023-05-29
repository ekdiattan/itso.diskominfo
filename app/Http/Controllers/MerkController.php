<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;
use Illuminate\Support\Facades\DB;

class MerkController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request){
            $merk = DB::table('merks')->where('merk', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $merk = DB::table('merks')->where('merk', true)->paginate(10);
        }
        return view('home.master.merk.index',['merks'=> $merk, 'title' => 'Merk']);
    }

    public function create()
    {
        return view('home.master.merk.create', ['title' => 'Merk']);
    }

    public function store(Request $request)
    {
        Merk::create($request->all());
        return redirect('/merk');
    }

    public function show($id)
    {
        $merk = Merk::find($id);
        $edit = Merk::find($id);
        return view('home.master.merk.edit', ['merk' => $merk,'edit' =>$edit, 'title' => 'Merk']);
    }

    public function edit($id)
    {
        // $merk = Merk::find($id);
        // return view('home.merk.edit', ['merk' => $merk]);
    }

    public function update(Request $request, $id)
    {
        $merk = Merk::find($id);
        $merk->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil Mengupdate data!');

        return redirect('/merk')->with('success', 'Berhasil Mengupdate Data');
    }

    public function delete($id)
    {
        $merk = Merk::find($id);
        $merk->delete();
        session()->flash('success', 'Merk Berhasil dihapus');
        
        return redirect('/merk')->with('success', 'Merk berhasil dihapus');
    }

    public function destroy(Merk $merk)
    {
       Merk::destroy($merk->id);
        return redirect('/merk')->with('succes', 'merk has been deleted');
    }
}
