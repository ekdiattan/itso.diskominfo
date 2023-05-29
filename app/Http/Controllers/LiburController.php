<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Libur;
use Illuminate\Support\Facades\DB; 

class LiburController extends Controller
{
    public function index(Request $request){

        if($request){
            $liburs = DB::table('liburs')->where('nama', 'ilike', '%'.$request->search2.'%')->paginate(10);
        }else{
            $liburs = DB::table('liburs')->where('nama', true)->paginate(10);
        }
        return view('home.master.libur.index', ['title' => "Libur Nasional", 'liburs' => $liburs]);
    }
    // $liburs = Libur::all();  

    public function store(Request $request){
        $parsedDate = Carbon::create($request->tanggal)->format('Y-m-d'); // Format : 2023-01-19 untuk menyesuaikan dengan data tanggal di model Cuti
        Libur::create([
            'nama' => $request->namaLibur,
            'tanggal' => $parsedDate
        ]);

        return redirect('/libur');
    }

    public function edit($id){
        $holiday = Libur::find($id);

        return view('home.master.libur.edit', ['title' => "Libur Nasional", 'libur' => $holiday]);
    }

    public function update(Request $request, $id){
        $holiday = Libur::find($id);
        $holiday->update([
            'nama' => $request->namaLibur,
            'tanggal' => $request->tanggal
        ]);

        return redirect('/libur');
    }

    public function delete($id){
        $holiday = Libur::find($id);
        $holiday->delete();

        return redirect('/libur')->with('success', 'Data berhasil dihapus');
    }
}
