<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Booking;
use App\Models\Pegawai;
use App\Models\DtPegawai;

class DashboardController extends Controller
{
    public function index(Request $request){
        
        $laporan = Laporan::all();
        $booking = Booking::all();
        $pegawai = Pegawai::all();
        $nonpns = DtPegawai::whereNot('jabatan', 'PNS')->where('isActive','true')->get();

        return view('home.dashboard', ["title" => "Dashboard", 'laporan' => sizeof($laporan),'booking' => sizeof($booking),'pegawai' => sizeof($pegawai),'nonpns' => sizeof($nonpns)]);
    }
}
