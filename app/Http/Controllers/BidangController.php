<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBidangRequest;
use App\Http\Requests\UpdateBidangRequest;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        if($request){
            $bidang = DB::table('bidangs')->where('namabidang', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $bidang = DB::table('bidangs')->where('namabidang', true)->paginate(10);
        }
        // dd($urut);

        return view('home.master.bidang.index', ['bidangs'=> $bidang, 'title' => 'Bidang']);
    }

    public function create()
    {
        return view('home.master.bidang.create', ['title' => 'Bidang']);
    }

    public function store(Request $request)
    {

        Bidang::create($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/bidang');
    }

    public function show($id)
    {
        $bidang = Bidang::find($id);
        $edit = Bidang::find($id);

        return view('home.master.bidang.edit',['bidangs'=> $bidang,'data'=> $bidang, 'title' => 'Bidang']);
    }

    public function edit($id)
    {
        // $edit = Bidang::find($id);
     
        // return view ('home.bidang.edit',[
        //     'data'=>$edit
        // ]);
    }

    public function update(Request $request, $id)
    {
        $bidang = Bidang::find($id);
        $bidang->update($request->all());
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/bidang')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(Bidang $bidang)
    {
        Bidang::destroy($bidang->id);
        return redirect('/bidang')->with('succes', 'Bidang has been deleted');
    }

    // delete
    public function delete($id)
    {
        $bidang = Bidang::find($id);
        $bidang->delete();
        $id->accepts('session');
        session()->flash('success', 'Bidang Berhasil dihapus');
        
        return redirect('/bidang')->with('success', 'Bidang berhasil dihapus');
    }
    
}