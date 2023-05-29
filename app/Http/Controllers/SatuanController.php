<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB; 

class SatuanController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request){
            $satuan = DB::table('satuans')->where('satuan', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $satuan = DB::table('satuans')->where('satuan', true)->paginate(10);
        }
        return view('home.master.satuan.index',['satuans'=> $satuan, 'title' => 'Satuan']);
    }

    public function store(Request $request)
    {
        Satuan::create($request->all());
        return redirect('/satuan');
    }

    // public function show($id)
    // {
    //     $edit= Satuan::find($id);
    //     $satuan = Satuan::find($id);
    //     return view('home.satuan.edit', ['satuan' => $satuan]);
    // }

    public function edit($id)
    {
        $satuan = Satuan::find($id);
        return view('home.master.satuan.edit', ['satuan' => $satuan, 'title' => 'Satuan']);
    }
    
    public function update(Request $request, $id)
    {
        $satuan = Satuan::find($id);
        $satuan->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil Mengupdate data!');

        return redirect('/satuan')->with('success', 'Berhasil Mengupdate Data');
    }

    public function delete($id)
    {
        $satuan = Satuan::find($id);
        $satuan->delete();
        session()->flash('success', 'Satuan Berhasil dihapus');
        
        return redirect('/satuan')->with('success', 'Satuan berhasil dihapus');
    }

    public function destroy(Satuan $satuan)
    {
       Satuan::destroy($satuan->id);
        return redirect('/satuan')->with('succes', 'satuan has been deleted');
    }
}
