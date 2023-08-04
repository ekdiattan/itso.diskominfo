<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@extends('home.partials.main')
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<ol class="breadcrumb">
    <li class="breadcrumb-item active" style="color:black;"><h2>Detail Data Peminjaman<h2></li>
  </ol>
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/permohonan-store" method="post" enctype="multipart/form-data">
        @csrf
        <p class="card-description">Permohonan Peminjaman Aset</p>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tiket" name="tiket" value="{{ $booking->tiket }}" readonly/>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Pemohon</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="namaPemohon" name="namaPemohon" value="{{ $booking->namaPemohon }}" readonly/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nome Wa</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="noTelp" name="noTelp" value="{{ $booking->noTelp }}" readonly/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Bidang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $booking->bidang }}" readonly/>
              </div>
            </div>
          </div>
        </div><br>
        <p class="card-description">Aset yang diajukan</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Aset</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="namaAset" name="namaAset" value="{{ $booking->aset->merk }} {{ $booking->aset->nama }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Mulai Pinjam</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="mulai" name="mulai" value="{{ $booking->mulai }}"readonly/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Selesai Pinjam</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="selesai" name="selesai" value="{{ $booking->selesai }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Surat Permohonan</label>
              <div class="col-sm-9">
              @if($booking->suratPermohonan != 0)
              <object data="{{ asset($booking->suratPermohonan)}}" type="application/pdf" width="100%" height="300"></object>
              <!-- <a href="{{ asset($booking->suratPermohonan)}}" target="_blank" rel="noopener noreferrer"><embed src="{{ asset($booking->suratPermohonan)}}" style="max-height:300px; max-width:440px;"></a> -->
               @else
              <a href="/booking-export/{{$booking->id}}">Cetak Surat</a>
              @endif
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal Permohonan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tanggalPermohonan" name="tanggalPermohonan" value="{{ $booking->tanggalPermohonan }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status Peminjaman</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="status" name="status" value="{{ $booking->status }}" readonly/>
            </div>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Perihal</label>
              <div class="col-sm-9">
              <textarea class="form-control" id="perihal" name="perihal" rows="4" value="{{ $booking->perihal }}" readonly>{{ $booking->perihal }}</textarea>
              </div>
            </div>
          </div>
        </div>
        <p class="card-description">Peninjau</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Peninjau</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="penyetuju" name="penyetuju" value="{{ $booking->penyetuju }}" readonly/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Waktu Ditinjau</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="waktu" name="waktu" value="{{ $booking->waktu }}" readonly/>
              </div>
            </div>
          </div>
          @if(auth()->user()->hak_akses == 'Admin')
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hostname</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="hostname" name="hostname" value="{{ $booking->hostname }}" readonly/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ip</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ip" name="ip" value="{{ $booking->ip }}" readonly/>
              </div>
            </div>
          </div>
          @endif
        </div><br>
      </form>
      <a class="btn btn-danger" href="/booking" role="button">Kembali</a>
    </div>
  </div>
</div>
@endsection
