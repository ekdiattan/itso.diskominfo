<?php

namespace App\Http\Controllers;
use App\Models\Aset;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request){
        $aset = Aset::all();

        return view('home.master.aset.index', ['title' => 'Aset', 'asets'=> $aset,]);
    }

    public function store(Request $request)
    {

        Aset::create($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/aset');
    }

    public function show($id)
    {
        // $aset = Aset::find($id);
        // $edit = Aset::find($id);

        // return view('home.master.aset.edit',['asets'=> $aset, 'data'=> $aset, 'title' => 'Aset']);
    }

    public function edit($id)
    {
        $aset = Aset::find($id);
        $edit = Aset::find($id);
        return view('home.master.aset.edit',['asets'=> $aset, 'data'=> $aset, 'title' => 'Aset']);
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::find($id);
        $aset->update($request->all());
        // kalo di unhide
        if($request->isHide == ''){
            $aset->update([
                'isHide' => 'false'
            ]);
        }
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/aset')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(Aset $aset)
    {
        Aset::destroy($aset->id);
        return redirect('/aset')->with('succes', 'Aset has been deleted');
    }

    // delete
    public function delete($id)
    {
        $aset = Aset::find($id);
        $aset->delete();
        session()->flash('success', 'Aset Berhasil dihapus');
        
        return redirect('/aset')->with('success', 'Aset berhasil dihapus');
    }
}
