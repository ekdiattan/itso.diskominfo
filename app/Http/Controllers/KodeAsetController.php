<?php

namespace App\Http\Controllers;
use App\Models\KodeAset;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KodeAsetController extends Controller
{
    public function index(Request $request)
    {
        if($request){
            $kodeaset = DB::table('kode_asets')->where('kodeBarang', 'like', '%'.$request->search2.'%')->paginate(10);
        }else{
            $kodeaset = DB::table('kode_asets')->where('kodeBarang', true)->paginate(10);
        }
        // dd($urut);

        return view('home.master.kodeAset.index', ['kodeasets'=> $kodeaset, 'title' => 'Kode Aset']);
    }


    public function store(Request $request)
    {

        KodeAset::create($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/kodeAset');
    }

    public function show($id)
    {
        // $kodeaset = KodeAset::find($id);
        // $edit = KodeAset::find($id);

        // return view('home.kodeAset.edit',['kodeasets'=> $kodeaset, 'data'=> $kodeaset, 'title' => 'Aset']);
    }

    public function edit($id)
    {
        $kodeaset = KodeAset::find($id);
        $edit = KodeAset::find($id);

        return view('home.master.kodeAset.edit',['kodeasets'=> $kodeaset, 'data'=> $kodeaset, 'title' => 'Aset']);
    }

    public function update(Request $request, $id)
    {
        $kodeaset = KodeAset::find($id);
        $kodeaset->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/kodeAset')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(KodeAset $kodeaset)
    {
        KodeAset::destroy($kodeaset->id);
        return redirect('/kodeAset')->with('succes', 'Kode Aset has been deleted');
    }

    // delete
    public function delete($id)
    {
        $kodeaset = KodeAset::find($id);
        $kodeaset->delete();
        session()->flash('success', 'Kode Aset Berhasil dihapus');
        
        return redirect('/kodeAset')->with('success', 'Kode Aset berhasil dihapus');
    }
}
