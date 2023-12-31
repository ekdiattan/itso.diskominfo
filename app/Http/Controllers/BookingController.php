<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Aset;
use App\Models\Booking;
// use App\Models\CekLevel;
use App\Models\Pegawai;
use App\Models\DtPegawai;
use App\Models\UnitKerja;
use App\Models\ViewPegawaiUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotificationPemohon;
use App\Mail\BookingNotificationSelesai;
use App\Mail\BookingNotificationTolak;
use App\Mail\BookingNotificationSetuju;
use App\Mail\BookingNotificationTimAsset;
use App\Mail\BookingNotificationTimAssetAdmin;
use App\Models\User; 

use Telegram;
use PDF;

class BookingController extends Controller
{
    public function index (Request $request){
        
        $dalamPengajuan = Booking::where('status', 'Dalam Pengajuan')->orderBy('tiket', 'desc')->get();
        $duplicatePengajuan = Booking::select('aset_id')->where('status', 'Dalam Pengajuan')->groupBy('aset_id')->havingRaw('COUNT(aset_id) > 1')->get();

        $tiketsWithDuplicate=[];

        if ($duplicatePengajuan->count() > 0) {
            foreach ($duplicatePengajuan as $dup) {
                $asetId = $dup->aset_id;
                    $dupBooking = Booking::where('aset_id', $asetId)
                    ->where('status', 'Dalam Pengajuan')
                    ->get();
                
                    if ($dupBooking->count() > 1) {
                    // Loop untuk membandingkan setiap pasangan data booking
                    for ($i = 0; $i < $dupBooking->count(); $i++) {
                        for ($j = 0 ; $j < $dupBooking->count(); $j++) {
                            if($j==$i){
                                break;
                            }
                            $startTime1 = Carbon::parse($dupBooking[$i]->mulai)->toDateString();
                            $endTime1 = Carbon::parse($dupBooking[$i]->selesai)->toDateString();
                            $startTime2 = Carbon::parse($dupBooking[$j]->mulai)->toDateString();
                            $endTime2 = Carbon::parse($dupBooking[$j]->selesai)->toDateString();
                            
                            // Pengecekan tumpang tindih waktu menggunakan overlaps()
                            if (($startTime2<=$startTime1 && $startTime1 <= $endTime2) || ($startTime2 <= $endTime1 && $endTime1 <= $startTime2)) {
                                // Ada tumpang tindih waktu
                                $tiketsWithDuplicate[] = $dupBooking[$i]->tiket;
                                $tiketsWithDuplicate[] = $dupBooking[$j]->tiket;
                                // break ; // Keluar dari kedua loop secara bersamaan
                            }
                        }
                    }
                    }
                }
                
            }
            // dd($dupBooking);

            // dd($tiketsWithDuplicate);

        // change date format
        foreach($dalamPengajuan as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        $cekpengajuan = Booking::where('status', 'Dalam Pengajuan')->orderBy('tiket', 'desc')->get();
        foreach($cekpengajuan as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        return view('home.aset.booking.index', ['dalamPengajuan' => $dalamPengajuan,'dupAset'=>$tiketsWithDuplicate, 'title' => 'Booking', 'search' => $request->search]);
    }

    public function reject (Request $request){
        $ditolak = Booking::where('status', 'Ditolak')->orderBy('tiket', 'desc')->get();
        $dalamPengajuan = Booking::where('status', 'Dalam Pengajuan')->orderBy('tiket', 'desc')->get();
        // change date format
        foreach($ditolak as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        foreach($dalamPengajuan as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        return view('home.aset.booking.reject', ['ditolak' => $ditolak, 'dalamPengajuan' => $dalamPengajuan, 'title' => 'Booking', 'search' => $request->search]);
    }

    public function acc (Request $request){


        $disetujui = Booking::where('status', 'Disetujui')->orderBy('tiket', 'desc')->get();     

        $dalamPengajuan = Booking::where('status', 'Dalam Pengajuan')->orderBy('tiket', 'desc')->get();
        
        foreach($disetujui as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
           
        }
        foreach($dalamPengajuan as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        return view('home.aset.booking.acc', ['disetujui'=> $disetujui,'dalamPengajuan' => $dalamPengajuan,'title' => 'Booking', 'search' => $request->search]);
    }

    public function selesai (Request $request){
        $dalamPengajuan = Booking::where('status', 'Dalam Pengajuan')->orderBy('tiket', 'desc')->get();
        $selesai = Booking::where('status', 'Selesai')->orderBy('tiket', 'desc')->get();
        foreach($dalamPengajuan as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        foreach($selesai as $result){
            $result->tanggalPermohonan = Carbon::parse($result->tanggalPermohonan)->translatedFormat('d F Y');
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('H:i:s, d F Y');
            $result->selesai = Carbon::parse($result->selesai)->translatedFormat('H:i:s, d F Y');
        }
        return view('home.aset.booking.selesai', ['dalamPengajuan' => $dalamPengajuan, 'selesai' => $selesai, 'title' => 'Booking', 'search' => $request->search]);
    }
    
    //public
    public function permohonan(){
        $unitkerja = UnitKerja::select('id','namaUnit','aliasUnit','idUnitKerja')->distinct('aliasUnit')->get();
        $pegawai = ViewPegawaiUnitKerja::all();
        $aset =  Aset::all();
        $booked = Booking::select('aset_id', 'mulai', 'selesai')->where('status', '=', 'Disetujui')->get();
        return view('home.aset.booking.permohonan', [
            'title' => 'Permohonan Peminjaman',
            'aset' => $aset,
            'unitkerja' => $unitkerja,
            'pegawais' => $pegawai,
            'booked' => $booked,
            'before' => null
        ]);
    }
    
    public function permohonanCheck (Request $request){
        $periodNew = CarbonPeriod::create($request->mulai, $request->selesai);
        $unitkerja = UnitKerja::select('id','namaUnit','aliasUnit','idUnitKerja')->distinct('aliasUnit')->get();
        $pegawai = ViewPegawaiUnitKerja::all();
        $asets =  Aset::select('*')->where('status', 'tersedia')->whereNot('isHide', 'true')->where('jenis', $request->jenisAset)->get();
        
        $i = 0;
        foreach($asets as $result){ // looping aset
            foreach($result->booked as $book){ // looping booked per aset
                if($book->status == 'Disetujui'){
                    $periodOld = CarbonPeriod::create($book->mulai, $book->selesai);
                    if($periodOld->overlaps($periodNew)){ // terdapat konflik waktu
                        $asets->pull($i);
                        break;
                    }
                }
            }
            $i++;
        }
        $booked = Booking::select('aset_id', 'mulai', 'selesai')->where('status', '=', 'Disetujui')->get();
        return view('home.aset.booking.permohonan', [
            'title' => 'Permohonan Peminjaman',
            'aset' => $asets,
            'unitkerja' => $unitkerja,
            'pegawais' => $pegawai,
            'booked' => $booked,
            'before' => $request->all()
        ]);
    }

    public function booked (Request $request, $id){ // show booked schedule for an aset
        $aset = Aset::find($id);
        $booked = Aset::find($id)->booked->where('status', '=', 'Disetujui');
        // change datetime format
        foreach($booked as $book){
            $book->mulai = Carbon::parse($book->mulai)->format('H:i:s, d/m/Y');
            $book->selesai = Carbon::parse($book->selesai)->format('H:i:s, d/m/Y');
        }
        return view('home.aset.booking.booked', ['title' => 'Jadwal', 'aset' => $aset,'bookeds' => $booked]);
    }

    public function store (Request $request){
        $idasst = $request->input('aset');
        $cekid = Booking::where('aset_id',$idasst);
        if ($cekid){
            $startasst = $request->input('mulai');
            $endtasst = $request->input('selesai');
            $mulaiasst = Carbon::parse($startasst)->toDateString();
            $selesaiasst = Carbon::parse($endtasst)->toDateString();

            $bookd =  Booking::where('aset_id',$idasst)
                             ->where('mulai','<=',$selesaiasst)
                             ->where('selesai', '>=', $mulaiasst)
                             ->first();
            
            if ($bookd) {
                    $periodNew = CarbonPeriod::create($request->mulai, $request->selesai);
                    $unitkerja = UnitKerja::select('id','namaUnit','aliasUnit','idUnitKerja')->distinct('aliasUnit')->get();
                    $pegawai = ViewPegawaiUnitKerja::all();
                    $asets =  Aset::select('*')->where('status', 'tersedia')->whereNot('isHide', 'true')->where('jenis', $request->jenisAset)->get();
            
                    $i = 0;
                    foreach($asets as $result){ // looping aset
                    foreach($result->booked as $book){ // looping booked per aset
                        if($book->status == 'Disetujui'){
                            $periodOld = CarbonPeriod::create($book->mulai, $book->selesai);
                                if($periodOld->overlaps($periodNew)){ // terdapat konflik waktu
                                $asets->pull($i);
                                break;
                            }
                        }
                        $request->session()->flash('error', 'Aset tidak tersedia pada periode tersebut!');
                    }
                    $i++;
                    }
                $booked = Booking::select('aset_id', 'mulai', 'selesai')->where('status', '=', 'Disetujui')->get();
                return view('home.aset.booking.permohonan', [
                'title' => 'Permohonan Peminjaman',
                'aset' => $asets,
                'unitkerja' => $unitkerja,
                'pegawais' => $pegawai,
                'booked' => $booked,
                'before' => $request->all()
            ]);
            }
        }
        
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($startMonth, $endMonth);
        $periods = [];
        foreach($period as $result){
            array_push($periods, $result->format('Y-m-d'));
        }
        $checking = Booking::select('tiket')->whereIn('tanggalPermohonan', $periods)->get(); // check data on this month
        // check for new month
        if(date('d') == 01 && $checking->toArray() == null){ // when date is 01 and when none data on this month
            $newTicket = 0;
        } else if (date('d') == 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = Booking::select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = Booking::select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() == null){ // when date is not 01 and there no data in this month
            $newTicket = 0;
        }
        
        $tiket = 'B'.date('y').date('m').sprintf('%03u', $newTicket+1); // generate ticket with L{year}{month}{3digits of ticket number}
        
        $booking = Booking::create([
            'aset_id' => $request->aset,
            'tiket' => $tiket,
            'namaPemohon' => $request->namaPemohon,
            'nip' => $request->nip,
            'noTelp' => $request->noTelp,
            'bidang' => $request->unitkerja,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'keperluan' => $request->keperluan,
            'perihal' => $request->perihal,
            'nama_email' => $request->nama_email,
            'tanggalPermohonan' => date("Y-m-d"),
            'hostname' =>gethostname(),
            'ip' =>$_SERVER['REMOTE_ADDR']
        ]);
        $request->accepts('session');
        
        session()->flash('success', 'Permohonan Berhasil Dibuat!');

        $mulai = Carbon::parse($booking->mulai);
        $selesai = Carbon::parse($booking->selesai);

        // Telegram buat kirim dari public itso.diskominfo.jabarprov.go.id

        $phoneNumber = $booking->noTelp;

        if($phoneNumber[0] == '0' && $phoneNumber[1] == '8'){
            $phoneNumber = ltrim($phoneNumber, '0');
        }

        Telegram::sendMessage([
            'chat_id' => '-1001781912074',
            'message_thread_id' => '3',
            'text' => 'Ada permohonan booking sebagai berikut'.PHP_EOL.PHP_EOL.
            'Nomor Tiket : '.$booking->tiket.PHP_EOL.
            'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
            'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
            'Kontak : '. 'wa.me/'.'+62'.$phoneNumber.PHP_EOL.
            'Periode Permohonan : '.PHP_EOL.$mulai->format('H:i, d M Y').' s.d.'.PHP_EOL.$selesai->format('H:i, d M Y').PHP_EOL.PHP_EOL.
            // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
            // 'Hostname: ' . gethostname().PHP_EOL.
            // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
            'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
        ]);
        // Telegram::sendMessage([
        //     'chat_id' => '-1001613610994',
        //     'text' => 'Ada permohonan booking sebagai berikut'.PHP_EOL.PHP_EOL.
        //     'Nomor Tiket : '.$booking->tiket.PHP_EOL.
        //     'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
        //     'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
        //     'Periode Permohonan : '.PHP_EOL.$mulai->format('G:i, d M Y').' s.d.'.PHP_EOL.$selesai->format('H:i, d M Y').PHP_EOL.PHP_EOL.
           
        //     'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
        // ]);
         // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
            // 'Hostname: ' . gethostname().PHP_EOL.
            // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
        
        Mail::to($booking->nama_email)->send(new BookingNotificationPemohon($booking, $mulai, $selesai));
        
        // Mengirim email ke semua alamat email di UserController
        $users = User::all(); // Mengambil semua data user dari UserController

        foreach ($users as $user) {
            $email = $user->email;
        
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($email)->send(new BookingNotificationTimAssetAdmin($booking, $mulai, $selesai));
            } else {
                // Lakukan tindakan lain jika alamat email tidak valid
            }
        }
        $aset = $booking->aset;
        $aset->update([
            'status' => 'tidak tersedia'
        ]);
        return redirect("/permohonan-result/$booking->id");
    }
    
    public function result($id){
        $booking = Booking::find($id);
        $booking->tanggalPermohonan = Carbon::parse($booking->tanggalPermohonan)->translatedFormat('d F Y');
        $booking->mulai = Carbon::parse($booking->mulai)->translatedFormat('H:i:s, d F Y');
        $booking->selesai = Carbon::parse($booking->selesai)->translatedFormat('H:i:s, d F Y');
        return view('home.aset.booking.result', ['title' => 'Permohonan', 'data' => $booking]); // bakalan bisa di pisahin
    }
        
    //admin
    public function create (){
        //$pegawai = ViewPegawaiUnitKerja::all();
        //$pegawai = Pegawai::all();
        //$unitkerja = UnitKerja::all();
        $unitkerja = UnitKerja::select('id','namaUnit','aliasUnit','idUnitKerja')->distinct('aliasUnit')->get();
        $pegawai = ViewPegawaiUnitKerja::all();
        $aset =  Aset::all();
        return view('home.aset.booking.create', [
            'title' => 'Peminjaman',
            'aset' => $aset,
            'unitkerja' => $unitkerja,
            'pegawais' => $pegawai,
            'before' => null
        ]);
    }
    
    public function bookingCheck(Request $request){
        $periodNew = CarbonPeriod::create($request->mulai, $request->selesai);
        //$unitkerja = UnitKerja::all();
        //$pegawai = Pegawai::all();
        $unitkerja = UnitKerja::select('id','namaUnit','aliasUnit','idUnitKerja')->distinct('aliasUnit')->get();
        $pegawai = ViewPegawaiUnitKerja::all();
        $asets =  Aset::select('*')->where('status', 'tersedia')->whereNot('isHide', 'true')->where('jenis', $request->jenisAset)->get();
        // $asetFiltered = array();
        
        $i = 0;
        foreach($asets as $result){ // looping aset
            foreach($result->booked as $book){ // looping booked per aset
                if($book->status == 'Disetujui'){
                    $periodOld = CarbonPeriod::create($book->mulai, $book->selesai);
                    if($periodOld->overlaps($periodNew)){ // terdapat konflik waktu
                        $asets->pull($i);
                        break;
                    }
                }
            }
            $i++;
        }
        return view('home.aset.booking.create', [
            'title' => 'Peminjaman',
            'aset' => $asets,
            'unitkerja' => $unitkerja, 
            'pegawais' => $pegawai,
            'before' => $request->all()
        ]);
    }
    
    public function buat (Request $request){
        // dd($request->all());
        $users = User::all();
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($startMonth, $endMonth);
        $periods = [];
        foreach($period as $result){
            array_push($periods, $result->format('Y-m-d'));
        }

        $today = date('Y-m-d');
        $checking = Booking::select('tiket')->whereIn('tanggalPermohonan', $periods)->get(); // check data on this month
        // dd($checking);

        // check for new month
        if(date('d') == 01 && $checking->toArray() == null){ // when date is 01 and when none data on this month
            $newTicket = 0;
        } else if (date('d') == 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = Booking::select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() != null){ // when date is 01 and there are some datas in this month
            $ticket = Booking::select('tiket')->orderBy('id', 'desc')->first(); // get last ticket used before
            // check report in this month
            $newTicket = substr($ticket->tiket, -3); // get last 3 character from string ticket
        } else if (date('d') != 01 && $checking->toArray() == null){ // when date is not 01 and there no data in this month
            $newTicket = 0;
        }
        $tiket = 'B'.date('y').date('m').sprintf('%03u', $newTicket+1); // generate ticket with L{year}{month}{3digits of ticket number}

        if($request->jenisAset == "Kendaraan" || $request->jenisAset == "Barang"){
            $booking = Booking::create([
                'aset_id' => $request->aset,
                'tiket' => $tiket,
                'namaPemohon' => $request->namaPemohon,
                'nip' => $request->nip,
                'noTelp' => $request->noTelp,
                'bidang' => $request->unitkerja,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'keperluan' => $request->keperluan,
                'perihal' => $request->perihal,
                'nama_email' => $request->nama_email,
                'tanggalPermohonan' => date("Y-m-d"),
                'status' => 'Disetujui',
                'hostname' =>gethostname(),
                'ip' =>$_SERVER['REMOTE_ADDR']
            ]);
        }else if($request->jenisAset == "Ruangan"){
            $booking = Booking::create([
                'aset_id' => $request->aset,
                'tiket' => $tiket,
                'namaPemohon' => $request->namaPemohon,
                'nip' => $request->nip,
                'noTelp' => $request->noTelp,
                'bidang' => $request->unitkerja,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'keperluan' => $request->keperluan,
                'perihal' => $request->perihal,
                'nama_email' => $request->nama_email,
                'tanggalPermohonan' => date("Y-m-d"),
                'status' => 'Selesai',
                'hostname' =>gethostname(),
                'ip' =>$_SERVER['REMOTE_ADDR']
            ]);  
        }

        $request->accepts('session');

        $phoneNumber = $booking->noTelp;

        if($phoneNumber[0] == '0' && $phoneNumber[1] == '8'){
            $phoneNumber = ltrim($phoneNumber, '0');
        }
        $mulai = Carbon::parse($booking->mulai);
        $selesai = Carbon::parse($booking->selesai);
        Telegram::sendMessage([
            'chat_id' => '-1001781912074',
            'message_thread_id' => '3',
            'text' => 'Ada permohonan booking sebagai berikut'.PHP_EOL.PHP_EOL.
            'Nomor Tiket : '.$booking->tiket.PHP_EOL.
            'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
            'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
            'Kontak : '. 'wa.me/'.'+62'.$phoneNumber.PHP_EOL.
            'Periode Permohonan : '.PHP_EOL.$mulai->format('H:i, d M Y').' s.d.'.PHP_EOL.$selesai->format('H:i, d M Y').PHP_EOL.PHP_EOL.
            'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
        ]);
        
        Telegram::sendMessage([
            'chat_id' => '-1001613610994',
            'text' => 'Ada permohonan booking sebagai berikut'.PHP_EOL.PHP_EOL.
            'Nomor Tiket : '.$booking->tiket.PHP_EOL.
            'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
            'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
            'Kontak : '. 'wa.me/'.'+62'.$phoneNumber.PHP_EOL.
            'Periode Permohonan : '.PHP_EOL.$mulai->format('H:i, d M Y').' s.d.'.PHP_EOL.$selesai->format('H:i, d M Y').PHP_EOL.PHP_EOL.
            'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
        ]);

        Mail::to($booking->nama_email)->send(new BookingNotificationPemohon($booking, $mulai, $selesai));

        foreach ($users as $user) {
            $email = $user->email;
        
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($email)->send(new BookingNotificationTimAsset($booking, $mulai, $selesai));
            } else {
                // Lakukan tindakan lain jika alamat email tidak valid
            }
        }   

        session()->flash('success', 'Permohonan Berhasil Dibuat!');
        return redirect('/booking');
    }

    public function show($id)
    {
        $booking= Booking::find($id);
        $booking->mulai = Carbon::parse($booking->mulai)->translatedFormat('H:i, d F Y');
        $booking->selesai = Carbon::parse($booking->selesai)->translatedFormat('H:i, d F Y');
        $booking->tanggalPermohonan = Carbon::parse($booking->tanggalPermohonan)->translatedFormat('d F Y');
        $aset = $booking->aset->first();
        return view('home.aset.booking.show',['booking'=> $booking, 'title' => 'Booking', 'aset' => $aset]);
    }

    public function edit($id)
    {
        $edit= Booking::find($id);
        $aset = $edit->aset;
        $edit->mulai = Carbon::parse($edit->mulai)->translatedFormat('H:i, d F Y');
        $edit->selesai = Carbon::parse($edit->selesai)->translatedFormat('H:i, d F Y');
        $edit->tanggalPermohonan = Carbon::parse($edit->tanggalPermohonan)->translatedFormat('d F Y');
        return view('home.aset.booking.edit',['edit'=> $edit, 'title' => 'Booking', 'aset' => $aset]);
    }

    public function update(Request $request, $id)
    {   
       $booking = Booking::find($id);
       $aset = $booking->aset;
        // validate file uploaded by user
        if($request->suratPermohonan != null){
            $request->validate([
             'suratPermohonan' => 'required|max:2048|mimes:pdf'
             ]);
             $extension = explode('.', $request->file('suratPermohonan')->getClientOriginalName());
             // move uploaded file into directory
             $surat = $request->file('suratPermohonan')->move('file/mail/', $booking->tiket.'-'.now()->format('G:i:s, d-m-Y').'.'.end($extension));
             
             $booking->update([
                 'status' => $request->status,
                 'alasan' => $request->alasan,
                 'suratPermohonan' => $surat,
                 'penyetuju' => auth()->user()->nama,
                 'nipPenyetuju' => auth()->user()->nip,
                 'waktu' => now(),
                 'hostname' => $booking -> hostname. ',' .gethostname(),
                 'ip' => $booking -> ip. ',' .$_SERVER['REMOTE_ADDR']
             ]);  
        } else {
            $booking->update([
                'status' => $request->status,
                'alasan' => $request->alasan,
                'penyetuju' => auth()->user()->nama,
                'nipPenyetuju' => auth()->user()->nip,
                'waktu' => now(),
                'hostname' => $booking -> hostname. ',' .gethostname(),
                'ip' => $booking -> ip. ','  .$_SERVER['REMOTE_ADDR']
            ]);
        }
        if ($request->status ==='Disetujui') {
            Telegram::sendMessage([
                'chat_id' => '-1001781912074',
                'message_thread_id' => '3',
                'text' => 'Permohonan berikut telah disetujui oleh: ' . auth()->user()->nama . PHP_EOL . PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
            Telegram::sendMessage([
                'chat_id' => '-1001613610994',
                'text' => 'Permohonan berikut telah disetujui oleh: ' . auth()->user()->nama . PHP_EOL . PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
            Mail::to($booking->nama_email)->send(new BookingNotificationSetuju($booking, $booking->mulai, $booking->selesai));

            // Agar status kendaraan di aset otomatis terubah menjadi tidak tersedia ketika peminjaman disetujui
            $aset->update([
                'status' => 'tidak tersedia'
            ]); 

            session()->flash('success', 'Berhasil mengupdate data!');
            return redirect('/booking');

        } elseif ($request->status ==='Ditolak') {
            Telegram::sendMessage([
                'chat_id' => '-1001781912074',
                'message_thread_id' => '3',
                'text' => 'Mohon maaf permohonan berikut telah ditolak oleh: ' . auth()->user()->nama . PHP_EOL . PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                'Dengan alasan :' .$booking->alasan.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
            Telegram::sendMessage([
                'chat_id' => '-1001613610994',
                'text' => 'Mohon maaf permohonan berikut telah ditolak oleh: ' . auth()->user()->nama . PHP_EOL . PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                'Dengan alasan :' .$booking->alasan.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
        Mail::to($booking->nama_email)->send(new BookingNotificationTolak($booking, $booking->mulai, $booking->selesai));
        
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/booking');


        }elseif ($request->status ==='Selesai') {
            Telegram::sendMessage([
                'chat_id' => '-1001781912074',
                'message_thread_id' => '3',
                'text' => 'Permohonan anda telah selesai'.PHP_EOL.PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
            Telegram::sendMessage([
                'chat_id' => '-1001613610994',
                'text' => 'Permohonan anda telah selesai'.PHP_EOL.PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                // 'IP :'.$_SERVER['REMOTE_ADDR'] .PHP_EOL.
                // 'Hostname: ' . gethostname().PHP_EOL.
                // 'Perangkat: ' . request()->server('HTTP_USER_AGENT').PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
        Mail::to($booking->nama_email)->send(new BookingNotificationPemohon($booking, $booking->mulai, $booking->selesai));
       
        // Agar status kendaraan di aset otomatis terubah menjadi tersedia ketika peminjaman telah selesai
        $aset->update([
            'status' => 'tersedia'
        ]); 
       
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/booking');
        }
    }

    public function delete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        
        session()->flash('success', 'Peminjaman Berhasil dihapus');
        return redirect('/booking')->with('success', 'Peminjaman berhasil dihapus');
    } 

    public function export($id){
        
        $todayTime = Carbon::now()->translatedFormat('l, d-m-Y');
        $data = Booking::find($id);
        $aset = $data->aset;
        $mjam = Carbon::parse($data->mulai)->translatedFormat('H:i');
        $mdate = Carbon::parse($data->mulai)->translatedFormat('d F Y');
        $sjam = Carbon::parse($data->selesai)->translatedFormat('H:i');
        $sdate = Carbon::parse($data->selesai)->translatedFormat('d F Y');
        $data->tanggalPermohonan = Carbon::parse($data->tanggalPermohonan)->translatedFormat('d F Y');
        $pdf = PDF::loadView('home.aset.booking.peminjaman_pdf',['datas'=>$data,'aset'=>$aset, 'mjam' => $mjam, 'mdate' => $mdate, 'sjam' => $sjam, 'sdate' => $sdate])->setPaper([0, 0, 595.27559055, 935.43307087], 'landscape');
        return $pdf->download('Permohonan-'.$todayTime.'.pdf');
    }
    public function edtasst($id){
        $edit= Booking::find($id);
        $aset = $edit->aset;
        return view('home.aset.booking.editselesai',['edit'=> $edit, 'title' => 'Peminjaman', 'aset' => $aset]);
    }
    public function updbarang(Request $request, $id){ 
        $booking= Booking::find($id);
        $booking->update([
            //'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
         $aset = $booking->aset;
        $aset->update([
            'status' => 'tersedia'
        ]); 
        return redirect('/booking')->with('success', 'Peminjaman selesai');
    }
   //public function detailasset($id){
   //    $booking= Booking::find($id);
   //    $aset = $booking->aset;
   //    return view('home.aset.showselesai',['booking'=> $booking, 'title' => 'Aset', 'aset' => $aset]);
   //}
   //public function updasst(Request $request, $id){ 
   //    $booking= Booking::find($id);
   //    $booking->update([
   //        'keterangan' => $request->keterangan
   //    ]);
   //}
    // Keamanan
    public function beranda(Request $request){ // mesti di filter
        // dd(Booking::all());
        if($request->search == null){
            $disetujui = Booking::where('status', 'Disetujui')->orderBy('tiket', 'desc')->get();
            $dipinjam = Booking::where('status', 'Dipinjam')->orderBy('tiket', 'desc')->get();
        } else {
            $disetujui = Booking::where('status', 'Disetujui')->where('namaPemohon', 'ilike', '%'.$request->search.'%')->orwhere('bidang', 'ilike', '%'.$request->search.'%')->orwhere('tanggalPermohonan', 'ilike', '%'.$request->search.'%');
            $dipinjam = Booking::where('status', 'Dipinjam')->where('namaPemohon', 'ilike', '%'.$request->search.'%')->orwhere('bidang', 'ilike', '%'.$request->search.'%')->orwhere('tanggalPermohonan', 'ilike', '%'.$request->search.'%')->orderBy('tiket', 'desc')->get();
        } 
        // convert time format
        foreach($dipinjam as $result){
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('d F Y');
        }
        foreach($disetujui as $result){
            $result->mulai = Carbon::parse($result->mulai)->translatedFormat('d F Y');
        }
        return view('home.keamanan.index',['title' => 'Kendaraan','disetujui' => $disetujui,'dipinjam' => $dipinjam]);
    }

    public function riwayat(Request $request){
        if($request->search == null){
            $selesai = Booking::where('status', 'Selesai')->orderBy('tiket', 'desc')->get();
        } else {
            $selesai = Booking::where('status', 'Selesai')->where('namaPemohon', 'ilike', '%'.$request->search.'%')->orwhere('bidang', 'ilike', '%'.$request->search.'%')->orwhere('tanggalPermohonan', 'ilike', '%'.$request->search.'%')->orderBy('tiket', 'desc')->get();
        }
        return view('home.keamanan.riwayat',['title' => 'Kendaraan','selesai' => $selesai,]);
    }

    public function riwayatdetail($id){
        $booking= Booking::find($id);
        $aset = $booking->aset;
        return view('home.keamanan.riwayatdetail',['booking'=> $booking, 'title' => 'Kendaraan', 'aset' => $aset]);
    }

    public function detail($id){
        $booking= Booking::find($id);
        $aset = $booking->aset;
        return view('home.keamanan.show',['booking'=> $booking, 'title' => 'Kendaraan', 'aset' => $aset]);
    }

    public function edt($id){
        $edit= Booking::find($id);
        $aset = $edit->aset;
        return view('home.keamanan.edit',['edit'=> $edit, 'title' => 'Kendaraan', 'aset' => $aset]);
    }
    public function proses($id){
        $edit= Booking::find($id);
        $aset = $edit->aset;
        $pegawai = Pegawai::all();
        $dtpegawais = DtPegawai::all();
        // dd($edit);
        return view('home.keamanan.proses',['dtpegawais' => $dtpegawais, 'pegawais' => $pegawai, 'edit'=> $edit, 'title' => 'Kendaraan', 'aset' => $aset]);
    }

    public function dipinjam($id){
        $edit= Booking::find($id);
        $aset = $edit->aset;
        $pegawai = Pegawai::all();
        $dtpegawais = DtPegawai::all();
        // dd($edit);
        return view('home.keamanan.dipinjam',['dtpegawais' => $dtpegawais, 'pegawais' => $pegawai, 'edit'=> $edit, 'title' => 'Kendaraan', 'aset' => $aset]);
    }

    public function upd(Request $request, $id){ 
        $booking= Booking::find($id);
        $booking->update([
            'kebersihan' => $request->kebersihan,
            'bahanBakar' => $request->bahanBakar,  
            'keterangan' => $request->keterangan
        ]);
        
        $aset = Aset::find($booking->aset_id);
        $aset->update([
            'kebersihan' => $request->kebersihan,
            'bahanBakar' => $request->bahanBakar,
            'keterangan' => $request->keterangan
        ]);
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/keamanan/'.$id);
    }
    public function updproses(Request $request, $id){ 
        $booking= Booking::find($id);
        $booking->update([
            'status' => $request->status,
            'pengambilKunci' => $request->pengambilKunci,
            'pengembaliKunci' => $request->pengembaliKunci,
            'penanggungJawab' => auth()->user()->nama
        ]);
        // dd($booking);
        if ($request->status ==='Dipinjam') {
            Telegram::sendMessage([
                'chat_id' => '-1001613610994',
                'text' => 'Kunci Kendaraan sudah dipinjam: '.PHP_EOL.PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                'Pengambil Kunci : '.$booking->pengambilKunci.PHP_EOL.
                'Pemberi Kunci : '.$booking->penanggungJawab.PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/keamanan');
        }elseif ($request->status ==='Selesai') {
            // Telegram::sendMessage([
            //     'chat_id' => '-902481775',
            //     'text' => 'Permohoan anda telah selesai'.PHP_EOL.PHP_EOL.
            //     'Nomor Tiket : '.$booking->tiket.PHP_EOL.
            //     'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
            //     'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
            //     'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
            //     'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            // ]);
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/booking');
        }
    }

    public function updpinjam(Request $request, $id){ 
        $booking= Booking::find($id);
        $booking->update([
            'status' => $request->status,
            'pengembaliKunci' => $request->pengembaliKunci,
            'kebersihan' => $request->kebersihan,
            'bahanBakar' => $request->bahanBakar,
            'keterangan' => $request->keterangan
        ]);
        // dd($booking)
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/keamanan');
        if ($request->status ==='Selesai') {
            Telegram::sendMessage([
                'chat_id' => '-902481775',
                'text' => 'Permohoan anda telah selesai'.PHP_EOL.PHP_EOL.
                'Nomor Tiket : '.$booking->tiket.PHP_EOL.
                'Nama Pemohon : '.$booking->namaPemohon.PHP_EOL.
                'Nama Aset : '.$booking->aset->merk.' '.$booking->aset->nama.` ($booking->aset->kodeUnit)`.PHP_EOL.
                'Periode Peminjaman: '.PHP_EOL.date('H:i, d M Y', strtotime($booking->mulai)).' s.d.'.PHP_EOL.date('H:i, d M Y', strtotime($booking->selesai)).PHP_EOL.PHP_EOL.
                'Detail: http://itso.diskominfo.jabarprov.go.id/tracking/'.$booking->tiket
            ]);
        session()->flash('success', 'Berhasil mengupdate data!');
        return redirect('/booking');
        }
    }

    
 
  
}
