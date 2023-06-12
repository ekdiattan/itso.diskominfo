@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Detail Data Peminjaman</h3>
</div>
<a href="/keamanan" class="btn btn-danger">Kembali</a><br>

<div class="col-lg-12 grid-margin stretch-card"><br>

<div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto" style="color:black;">
            <b>{{$booking->tiket}} | {{$booking->namaPemohon}}</b>
        </a>
    </div>
    <div class="nav navbar navbar-expand navbar-light bg-light border-bottom p-0">
      <div class="container justify-content-center justify-content-md-between">
        <ul class="navbar-nav flex-row">
            @if($booking->status == "Disetujui")
            <li class="nav-item me-auto">
                <a href="/keamanan-edit/{{ $booking->id }}" class="nav-link" style="font-size:20px;color:green;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                Cek Kendaraan
                </a>
            </li>
            <li class="nav-item me-auto">
                <a href="/keamanan-proses/{{ $booking->id }}" class="nav-link" style="font-size:20px;color:blue;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                Proses
                </a>
            </li>
            @endif
            @if($booking->status == "Dipinjam")
            <li class="nav-item me-auto">
                <a href="/keamanan-dipinjam/{{ $booking->id }}" class="nav-link" style="font-size:20px;color:green;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                Cek Kendaraan
                </a>
            </li>
            @endif
        </ul> 
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body"> 
            <div class="form-group">
                <label for="exampleInputUsername1">No Tiket</label>
                <input type="text" class="form-control" id="tiket" name="tiket"  maxlength="255" value="{{$booking->tiket}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Nama Pemohon</label>
                <input type="text" class="form-control" id="namaPemohon" name="namaPemohon"  maxlength="255" value="{{$booking->namaPemohon}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">No Telepon</label>
                <input type="text" class="form-control" id="noTelp"  name="noTelp" maxlength="255" value="{{$booking->noTelp}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Bidang</label>
                <input type="text" class="form-control" id="bidang" name="bidang"  maxlength="255" value="{{$booking->bidang}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Mulai</label>
                <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{$booking->mulai}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Selesai</label>
                <input type="datetime-local" class="form-control" id="selesai" name="selesai" value="{{$booking->selesai}}" readonly>
            </div>  
        </div>
    </div> 
</div>

<div class="col-md-5 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Nama Kendaraan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$aset->merk}} {{$aset->nama}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Perihal</label>
                <input type="text" class="form-control" id="perihal" name="perihal" value="{{$booking->perihal}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Surat Permohonan</label>
                <div class="col-sm-9">
                    @if($booking->suratPermohonan != 0)
                    <object data="{{ asset($booking->suratPermohonan)}}" type="application/pdf" width="100%" height="250"></object>
                    @else
                    <a href="/booking-export/{{$booking->id}}">Cetak Surat</a>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Tanggal Permohonan</label>
                <input type="text" class="form-control" id="tanggalPermohonan" name="tanggalPermohonan" value="{{$booking->tanggalPermohonan}}" readonly>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{$booking->status}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Kebersihan</label>
                <input type="text" class="form-control" id="kebersihan" name="kebersihan" value="{{$booking->kebersihan}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1" >Bahan Bakar</label>
                <input type="text" class="form-control" id="bahanBakar" name="bahanBakar" value="{{$booking->bahanBakar}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Pemberi Kunci</label>
                <input type="text" class="form-control" id="penanggungJawab" name="penanggungJawab" value="{{$booking->penanggungJawab}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Pengambil Kunci</label>
                <input type="text" class="form-control" id="pengambilKunci" name="pengambilKunci" value="{{$booking->pengambilKunci}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Pengembali Kunci</label>
                <input type="text" class="form-control" id="pengembaliKunci" name="pengembaliKunci" value="{{$booking->pengembaliKunci}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Kondisi Kendaraan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$booking->keterangan}}" readonly>
            </div>
        </div>
    </div>
</div>

  
@endsection
