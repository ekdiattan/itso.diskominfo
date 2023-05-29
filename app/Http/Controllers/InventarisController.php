<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inventaris;
use App\Models\KodeAset;
use App\Models\Bidang;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Exports\InventarisExport;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        if($request){
            $data = DB::table('inventaris')->where('namaBarang', 'ilike', '%'.$request->search.'%')->orwhere(
                'kondisiBarang', 'ilike', '%'.$request->search.'%')->orwhere(
                'merk', 'ilike', '%'.$request->search.'%')->orwhere(
                'tipe', 'ilike', '%'.$request->search.'%')->paginate(10);
        }else{
            $data = DB::table('inventaris')->where('namaBarang', true)->paginate(10);
        }
        return view('home.aset.inventaris.inventaris', compact('data'), ['title' => 'Inventaris', 'search' => $request->search]);
    }

    
    public function create()
    {
        $kodeaset = KodeAset::all();
        // dd($kodeaset);
        $now = Carbon::now();

        $tglLaporan = Carbon::now()->format('d/m/Y');
        $urut = DB::table('inventaris')->orderBy('namaBarang', 'desc')->first()->id;
        $thnBulan = $now->year . $now->month;
        

        // $kodeBarang = 'KDBRG -'. $thnBulan . sprintf('%03d', $urut+1);

        //bidang dan kategori
        $bidang = Bidang::all();
        $kategori= Kategori::all();
        $merk = Merk::all();
        $satuan = Satuan::all();

        return view('home.aset.inventaris.create', ['title' => 'Inventaris', 'merk' => $merk, 'satuan' => $satuan, 'kodeBarang' => $kodeaset]);
        // return view('home.inventaris.create', ['title' => 'Inventaris', 'merk' => $merk, 'satuan' => $satuan, 'kodeBarang' => $kodeBarang]);
    }

    public function store(Request $request)
    {

        $data = Inventaris::create([
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'namaBarang' => $request->namaBarang,
            'image' => $request ->image,
            'kondisiBarang' => $request->kondisiBarang,
            'noSertifikat' => $request->noSertifikat,
            'lokasi' => $request->lokasi,
            'caraPerolehan' => $request->caraPerolehan,
            'bulanPerolehan' => $request->bulanPerolehan,
            'tahunPerolehan' => $request->tahunPerolehan,
            'kuantitas' => $request->kuantitas,
            'satuan' => $request->satuan,
            'hargaSatuan' => $request->hargaSatuan,
            'nilaiPerolehan' => $request->nilaiPerolehan,
            'umurEkonomis' => $request->umurEkonomis,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'pengguna' => $request->pengguna,
            'noHp' => $request->noHp,
            'noBeritaAcara' => $request->noBeritaAcara,
        ]);
        if($request->hasFile('image')){
            $request->file('image')->move('images/inventaris/',$request->file('image')->getClientOriginalName());
            $data->image = $request->file('image')->getClientOriginalName();
            $data->save();
        }
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return redirect('/inventaris');
    }

    public function show($id)
    {
        
        $inventaris= Inventaris::find($id);

        return view('home.aset.inventaris.show',['edit'=> $inventaris, 'title' => 'Inventaris']);
    }

    public function edit($id)
    {
        $edit= Inventaris::find($id);
        $merk = Merk::all();
        $satuan = Satuan::all();

        return view('home.inventaris.edit',['edit'=> $edit, 'merk'=>$merk, 'satuan'=>$satuan, 'title' => 'Inventaris']);
    }

    public function update(Request $request, $id)
    {   
        $inventaris = Inventaris::find($id);
        $inventaris->update($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate data!');

        return redirect('/inventaris');
    }

    public function destroy(Inventaris $inventaris)
    {
       Inventaris::destroy($inventaris->id);
        return redirect('/inventaris')->with('succes', 'Laporan has been deleted');
    }
    
    public function delete($id)
    {
        $inventaris = Inventaris::find($id);

        $file = ('images/inventaris/').$inventaris->image;
        if(file_exists($file)){
            @unlink($file);
        }
        $inventaris->delete();
        // $id->accepts(session());
        session()->flash('success', 'Laporan Berhasil dihapus');
        
        return redirect('/inventaris')->with('success', 'Laporan berhasil dihapus');
    } 

    public function exportExcel()
    {
        return (new InventarisExport)-> download('Inventaris.xlsx');
    }


    
}