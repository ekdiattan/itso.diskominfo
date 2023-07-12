<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Libur;
use Illuminate\Support\Facades\DB; 

class LiburController extends Controller
{
    public function index(Request $request){
        $liburs = Libur::all();  
        // dd($liburs);
        return view('home.master.libur.index', ['title' => "Libur Nasional", 'liburs' => $liburs]);
    }

    public function store(Request $request){
        if($request->end != null){
            $period = CarbonPeriod::create($request->start, $request->end);
            foreach($period as $date){
                $parsedDate = Carbon::parse($date)->format('Y-m-d'); // Format : 2023-01-19 untuk menyesuaikan dengan data tanggal di model Cuti
                Libur::create([
                    'nama' => $request->namaLibur,
                    'tanggal' => $parsedDate
                ]);
            }
        } else {
            $parsedDate = Carbon::parse($request->tanggal)->format('Y-m-d'); // Format : 2023-01-19 untuk menyesuaikan dengan data tanggal di model Cuti
            Libur::create([
                'nama' => $request->namaLibur,
                'tanggal' => $parsedDate
            ]);
        }

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
