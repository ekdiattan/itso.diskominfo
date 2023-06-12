<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Laporan;
use App\Models\UnitKerja;
use App\Models\Kategori;
use App\Models\Solusi;
use App\Models\Pegawai;
use App\Models\DtPegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\ValidatedData;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if($request->search2 == null){
            $selesai = DB::table('laporans')->where('isDone', true)->orderBy('tanggalselesai', 'desc')->get();
            $belumSelesai = DB::table('laporans')->where('isDone', false)->orderBy('tanggalmencatat', 'desc')->get();
        } else {
            $selesai = DB::table('laporans')->where('isDone', true)->where(
                'namapelapor', 'ilike', '%'.$request->search2.'%')->orwhere(
                'kategori', 'ilike', '%'.$request->search2.'%')->orwhere(
                'tanggalmencatat', 'ilike', '%'.$request->search2.'%')->get();
            $belumSelesai = DB::table('laporans')->where('isDone', false)->where('namapelapor', 'ilike', '%'.$request->search.'%')->get();
        }

        // convert date format
        foreach($belumSelesai as $result){
            $result->tanggalmencatat = Carbon::parse($result->tanggalmencatat)->translatedFormat('d F Y');
            $result->tanggalselesai = Carbon::parse($result->tanggalselesai)->translatedFormat('d F Y');
        }

        foreach($selesai as $result){
            $result->tanggalmencatat = Carbon::parse($result->tanggalmencatat)->translatedFormat('d F Y');
            $result->tanggalselesai = Carbon::parse($result->tanggalselesai)->translatedFormat('d F Y');
        }

        return view('home.laporan.laporan', ['selesai'=> $selesai, 'belum' => $belumSelesai, 'title' => 'Catatan IT', 'search' => $request->search, 'search2' => $request->search2]);
    }

    public function create()
    {
        $tglLaporan = Carbon::now()->format('d-m-Y'); // date with 13/12/2023 format
        $unitkerja = UnitKerja::all();
        $pegawai = Pegawai::all();
        $dtpegawais = DtPegawai::all();
        return view('home.laporan.create', ['dtpegawais' => $dtpegawais, 'tglLaporan'=>$tglLaporan, 'unitkerja'=>$unitkerja, 'title' => 'Catatan IT', 'pegawais' => $pegawai]);
    }

    public function store(Request $request)
    {
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($startMonth, $endMonth);
        $periods = [];
        foreach($period as $result){
            array_push($periods, $result->format('Y-m-d'));
        }
        $checking = Laporan::select('tiket')->whereIn('tanggalmencatat', $periods)->get(); // check data on this month
        // check for new month
        if(date('d') == 01 && $checking->toArray() == null){ // when date is 01 and when none data on this month
            $newTicket = 0;
        } else if (date('d') == 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = DB::table('laporans')->select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = DB::table('laporans')->select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() == null){ // when date is not 01 and there no data in this month
            $newTicket = 0;
        }
        $tiket = 'L'.date('y').date('m').sprintf('%03u', $newTicket+1); // generate ticket with L{year}{month}{3digits of ticket number}
        Laporan::create([
            'tiket' => $tiket,
            'nippencatat' => auth()->user()->nip,
            'namapencatat' => auth()->user()->nama,
            'tanggalmencatat' => Carbon::parse($request->tanggalmencatat)->format('Y-m-d'),
            'namapelapor' => $request->namapelapor,
            'namabidang' => $request->unitkerja,
            'nomorhp' => $request->nomorhp,
            'permasalahan' => $request->permasalahan,
          
        ]);

        $request->accepts('session');
        session()->flash('success', 'Laporan berhasil dibuat!');
        return redirect('/laporan')->with('succes', 'New Post has been Added');
    }

    public function show($id)
    {
        $laporan = Laporan::find($id);
        $laporan->tanggalmencatat = Carbon::parse($laporan->tanggalmencatat)->translatedFormat('d F Y');
        $images = DB::table('solusis')->select('image')->where('tiket', '=', $laporan->tiket)->orderBy('created_at', 'desc')->get();
        $lastImage = DB::table('solusis')->select('image')->where('tiket', '=', $laporan->tiket)->orderBy('created_at', 'desc')->first();
        $unitkerja = UnitKerja::all();
        $kategori = Kategori::all();

        $solusis = DB::table('solusis')->where('tiket', '=', $laporan->tiket)->orderBy('created_at', 'desc')->get();

        $users = collect();
        foreach($solusis as $result){
            $users->push(
                DB::table('users')->select('nama')
                ->where('nip', '=', $result->nip)
                ->get()
            );
        }
        return view ('home.laporan.show',['unitkerja'=>$unitkerja,'kategori'=>$kategori, 'laporan'=> $laporan, 'solusis' => $solusis, 'users' => $users->collapse(), 'size' => sizeof($solusis), 'title' => 'Catatan IT', 'images' => $images, 'lastImage' => $lastImage]);
    }

    public function edit($id){
        return view('home.laporan.edit', [
            'laporan' => Laporan::find($id),
            'unitkerjas' => UnitKerja::all(),
            'pegawais' => Pegawai::all(),
            'title' => 'Catatan IT'
        ]);
    }

    public function update(Request $request, $id){
        $report = Laporan::find($id);
        $report->update([
            'namapelapor' => $request->namapelapor,
            'namabidang' => $request->unitkerja,
            'nomorhp' => $request->nomorhp,
            'permasalahan' => $request->permasalahan
        ]);

        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate Data!');
        return redirect('/laporan')->with('succes', 'Berhasil mengupdate laporan');
    }

    // do, make a solution
    public function execute($id)
    {
        $laporan = Laporan::find($id);
        $unitkerja = UnitKerja::all();
        $kategori = Kategori::all();
        return view ('home.laporan.execute',['unitkerja'=>$unitkerja,'kategori'=>$kategori, 'laporan'=> $laporan, 'title' => 'Catatan IT']);
    }
 
    // solution made
    public function executed(Request $request, $id)
    {
        $report = Laporan::find($id);
      
        // validate file uploaded by user
        $request->validate([
            'image' => 'max:2048|mimes::jpg,jpeg,png,bmp,pdf,docx,doc,xls,xlsx'
        ]);
        $extension = explode('.', $request->file('image')->getClientOriginalName());
        // move uploaded file into directory
        $image = $request->file('image')->move('images/laporan/', $report->tiket.'-'.auth()->user()->nip.'-'.now()->format('d-m-Y, G:i:s').'.'.end($extension));
       
        $report->update([
            'nipeksekutor' => auth()->user()->nip,
            'namaeksekutor' => auth()->user()->nama,
            'kategori' => $request->kategori,
            'status' => $request->status,
            'tanggalselesai' => Carbon::parse($request->tanggalselesai)->format("Y-m-d"),
            'namavendor' => $request->namavendor,
            'mulaiservice' => $request->mulaiservice,
            'selesaiservice' => $request->selesaiservice,
            'solusi' => $request->solusi
        ]);
        
        // set done when tanggalselesai inserted
        if($request->tanggalselesai != null){
            $report->update([
                'isDone' => 't'
            ]);
        }

        Solusi::create([
            'tiket' => Laporan::find($id)->tiket,
            'nip' => auth()->user()->nip,
            'solusi' => $request->solusi,
            'executionDate' => Carbon::parse($request->tanggalEksekusi)->format("Y-m-d"),
            'image' => $image
        ]);

        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate Data!');

        return redirect('/laporan')->with('succes', 'New Post has been Added');
    }

    public function destroy(Laporan $laporan)
    {
        Laporan::destroy($laporan->id);
        return redirect('/laporan')->with('success', 'Laporan has been deleted');
    }

    // delete
    public function delete($id)
    {
        $laporan = Laporan::find($id);
        $solusi = DB::table('solusis')->where('tiket', '=', $laporan->tiket)->get();
        // unlink image
        foreach($solusi as $result){
            $file = $result->image;
            if(file_exists($file)){
                @unlink($file);
            }
        }
        // delete old solusis
        foreach($solusi as $result){
            $data = Solusi::find($result->id);
            $data->delete();
        }
        
        $laporan->delete();
        session()->flash('success', 'Berhasil mengupdate Data!');
        
        return redirect('/laporan')->with('success', 'Laporan berhasil dihapus');
    }
}