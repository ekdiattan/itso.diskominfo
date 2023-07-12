<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TrackingController extends Controller
{
   

    public function index (){
        return view('home.tracking.index', ['title' => 'Public']);
    }


    public function track (Request $request){
        return view('home.tracking.tracking', ['title' => 'Tracking', 'laporan' => null, 'booking' => null, 'keyword' => null]);
    }

    public function laporPermasalahan (Request $request){
        return view('home.tracking.laporPermasalahan', ['title' => 'Lapor Permasalahan', 'laporan' => null]);
    }

    public function pinjam (Request $request){
        return view('home.tracking.pinjam', ['title' => 'Pinjam', 'laporan' => null]);
    }

    public function tes (Request $request){
        $booking = Booking::all();
        
        return view('home.tracking.tes2', ['title' => 'Pinjam','booking' => $booking]);
    }

    public function find(Request $request){
        if(substr($request->search, 0, 1) == 'L'){ // untuk CATATAN IT
            $laporans = Laporan::all(); 
            foreach($laporans as $laporan){
                if($laporan->tiket == $request->search){
                    $result = $laporan;
                    $solusis = DB::table('solusis')->where('tiket', '=', $laporan->tiket)->orderBy('created_at', 'desc')->get();
                    $images = DB::table('solusis')->select('image')->where('tiket', '=', $laporan->tiket)->orderBy('created_at', 'desc')->get();
                    $users = collect();
                    foreach($solusis as $solusi){
                        $users->push(
                            DB::table('users')->select('nama')
                            ->where('nip', '=', $solusi->nip)
                            ->get()
                        );
                    }
                    $users = $users->collapse();
                    $size = sizeof($solusis);
                    break;
                } else {
                    $result = null;
                    $solusis = null;
                    $size = null;
                    $users = null;
                    $images = null;
                }
            }    
            if (count((array)$result)) {
                // Tampilkan hasil pencarian
                return view('home.tracking.tracking', ['title' => 'Tracking', 'laporan' => $result, 'solusis' => $solusis, 'size' => $size, 'users' => $users, 'images' => $images, 'keyword' => $request->search, 'booking' => null, 'aset' => null]);
            } else {
                // Tampilkan pesan bahwa tidak ditemukan hasil pencarian
                return redirect('/tracking')->with('notFound', 'Pencarian tidak ditemukan');
            }
        } else if(substr($request->search, 0, 1) == 'B'){  // Untuk BOOKING
            $bookings = Booking::all();
            foreach($bookings as $booking){
                if($booking->tiket == $request->search){
                    $result = $booking;
                    break;
                } else {
                    $result = null;
                }
            }
            if (count((array)$result)) {
                // Tampilkan hasil pencarian);
                return view('home.tracking.tracking', ['title' => 'Tracking', 'laporan' => null, 'solusis' => null, 'size' => null, 'users' => null, 'images' => null, 'keyword' => $request->search, 'booking' => $result, 'aset' => $result->aset->first()]);
            } else {
                // Tampilkan pesan bahwa tidak ditemukan hasil pencarian
                return redirect('/tracking')->with('notFound', 'Pencarian tidak ditemukan');
            }
        } else {
            return redirect('/tracking')->with('invalid', 'Tiket tidak Valid!');
        }   
    }

    public function found($ticket){
        if(substr($ticket, 0, 1) == 'L'){
            $result = Laporan::where('tiket', $ticket)->first();
            return view('home.tracking.tracking', [
                'title' => 'Tracking', 'laporan' => $result, 'solusis' => null, 'size' => null, 'users' => null, 'images' => null, 'keyword' => null, 'booking' => null, 'aset' => null
            ]);
        } else if(substr($ticket, 0, 1) == 'B'){
            $result = Booking::where('tiket', $ticket)->first();
            return view('home.tracking.tracking', [
                'title' => 'Tracking', 'laporan' => null, 'solusis' => null, 'size' => null, 'users' => null, 'images' => null, 'keyword' => null, 'booking' => $result, 'aset' => $result->aset->first()
            ]);
        }
        
    }
}
