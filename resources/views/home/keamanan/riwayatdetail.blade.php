@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<ol class="breadcrumb">
    <li class="breadcrumb-item active" style="color:black;"><h2>Detail Data Riwayat Peminjaman<h2></li>
</ol>

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
                <label for="exampleInputUsername1">Penanggung Jawab</label>
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
