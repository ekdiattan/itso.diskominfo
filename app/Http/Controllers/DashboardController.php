<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Booking;
use App\Models\Pegawai;

class DashboardController extends Controller
{
    public function index(Request $request){
        
        $laporan = Laporan::all();
        $booking = Booking::all();
        $pegawai = Pegawai::all();

        return view('home.dashboard', ["title" => "Dashboard", 'laporan' => sizeof($laporan),'booking' => sizeof($booking),'pegawai' => sizeof($pegawai)]);
    }
}
