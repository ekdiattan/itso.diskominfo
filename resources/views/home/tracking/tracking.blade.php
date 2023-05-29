<link rel="shortcut icon" href="{{ asset('assets/images/jabar.png') }}">
@extends('home.partials.public')

<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
  </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5>Periksa Status Tiket Anda</h5>
</div> 

<br>
<div class="row">
<div class="card mx-auto my-auto">
  @if(session('notFound'))
  <div class="alert alert-danger m-3">
    {{ session('notFound') }}
  </div>
  @endif
  @if(session('invalid'))
  <div class="alert alert-danger m-3">
    {{ session('invalid') }}
  </div>
  @endif
  <div class="card-body p-4">
      <h5 style="text-align:center; font-family:fantasy;">Masukan Tiket Anda Disini</h3>
      <div class="row height d-flex justify-content-center align-items-center">
        <form action="/tracking" method="POST">
          @csrf
          <div class="col-md-15">
              <div class="input-group">
                <!-- <form class="d-flex" role="search"> -->
                  <input type="search" class="form-control rounded m-1" placeholder="Input Ticket" aria-label="Search" name="search" name="search"aria-describedby="search-addon" value="{{ ($keyword == 'null') ? '' : $keyword }}"/>
                  <!-- <input class="form-control rounded m-1" type="search" placeholder="Masukan Nama Pemohon" aria-label="Search" name="search" value=""> -->
                  <button type="submit" class="btn btn-outline-primary m-1">search</button>
               <!-- </form> -->
                  <a href="/tracking" type="button" class="btn btn-outline-danger m-1">reset</a>
              </div>   
          </div>
        </form>
      </div>
  </div>
  </div>
  </div>
  <br><br>

<!-- UNTUK LAPORAN/CATATAN IT -->
@if($laporan != null)
<div class="card mb-4">
    <div class="card-body">
    @if($laporan->isDone)
    <div class="alert alert-success" role="alert">
    <b>Status : Selesai</b>
    </div>
    @else
    <div class="alert alert-warning" role="alert">
    <b>Status : Dalam Proses</b>
    </div>
    @endif
      <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tiket" value='{{ $laporan->tiket }}'
                     readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tgl Mencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  id="tanggalmencatat" name="tanggalmencatat" value='{{ $laporan->tanggalmencatat }}' readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nip Pencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nippencatat" name="nippencatat" value='{{ $laporan->nippencatat }}'  readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapencatat" name="namapencatat" value='{{ $laporan->namapencatat }}'readonly/>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">Pelapor</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapelapor" name="namapelapor" value='{{ $laporan->namapelapor }}' readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namabidang" name="namabidang" value='{{ $laporan->namabidang }}' readonly />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Hp</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nomorhp" name="nomorhp" value='{{ $laporan->nomorhp }}' readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Permasalahan</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="permasalahan" name="permasalahan" rows="4"readonly>{{ $laporan->permasalahan }}</textarea>
                </div>
              </div>
            </div>
          </div>
          @if($size != 0)
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Solusi Masalah</label>
                <div class="col-sm-10">
                  <table class="table table-responsive table-hover table-bordered">
                    <thead class="bg-gray disabled color-palette">
                      <tr>
                        <td style="text-align: center; font-weight: bold; width:25%">Eksekutor</td>
                        <td style="text-align: center; font-weight: bold; width:40%">Solusi</td>
                        <td style="text-align: center; font-weight: bold; width:25%">Pada</td>
                        <td style="text-align: center; font-weight: bold; width:10%">Dokumentasi</td>
                      </tr>
                    </thead>
                    @for($i = 0; $i < $size; $i++)
                    <tbody>
                      <tr>
                        <td>{{ $users[$i]->nama }}</td>
                        <td>{{ $solusis[$i]->solusi }}</td>
                        <td>{{ $solusis[$i]->created_at }}</td>
                        <td><a href="/{{ $images[$i]->image }}" target="blank">Dokumentasi</a></td>
                      </tr>
                    </tbody>
                    @endfor
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
      </div>
    </div>
</div>
@endif

<!-- UNTUK BOOKING -->
@if($booking != null)
<div class="card mb-4">
    <div class="card-body">
    @if($booking->status == "Disetujui")
    <div class="alert alert-success" role="alert">
      <b>Status : Disetujui</b>
    </div>
    @elseif($booking->status == "Dalam Pengajuan")
    <div class="alert alert-warning" role="alert">
      <b>Status : Dalam Pengajuan</b>
    </div>
    @elseif($booking->status == "Dipinjam")
    <div class="alert alert-primary" role="alert">
      <b>Status : Dipinjam</b>
    </div>
    @elseif($booking->status == "Ditolak")
    <div class="alert alert-danger" role="alert">
      <b>Status : Ditolak</b>
    </div>
    @elseif($booking->status == "Selesai")
    <div class="alert alert-success" role="alert">
      <b>Status : Selesai</b>
    </div>
    @endif
      <h5 class="card-description">Data Peminjam</h5>
      <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tiket" value="{{ $booking->tiket }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Peminjam</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  id="namaPeminjam" name="namaPeminjam" value="{{ $booking->namaPemohon }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bidang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $booking->bidang }}"  readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="noTelp" name="noTelp" value="{{ $booking->noTelp }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <h5 class="card-description">Aset yang dipinjam</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Aset</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="aset" name="aset" value="{{ $booking->aset->merk }} {{ $booking->aset->nama }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kode Unit</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="kodeUnit" name="kodeUnit" value="{{ $booking->aset->kodeUnit }}" readonly />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Mulai</label>
                <div class="col-sm-9">
                  <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{ $booking->mulai }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Selesai</label>
                <div class="col-sm-9">
                  <input type="datetime-local" class="form-control" id="selesai" name="selesai" value="{{ $booking->selesai }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            @if($booking->alasan != null)
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alasan Ditolak</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="alasan" name="alasan" value="{{ $booking->alasan }}" readonly/>
                </div>
              </div>
            </div>
            @endif
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Perihal</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="perihal" name="perihal" rows="4"readonly>{{ $booking->perihal }}</textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status Peminjaman</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="status" name="status" value="{{ $booking->status }}" readonly/>
                </div>
              </div>
            </div>  
          </div>  
    <!-- <form method="post" action="/upload-surat/{{ $booking->id }}" enctype="multipart/form-data">  
      @csrf 
        <h5 class="card-description">Masukan Surat Permohonan</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Surat Permohonan</label>
              <div class="col-sm-9">
                <input type="file" class="form-control" id="suratPermohonan" name="suratPermohonan" accept=".pdf"/>
                <br>
                <button type="submit" class="btn btn-primary">Unggah</button>
              </div>
            </div>
          </div>
        </div>
    </form> -->
    </div>
</div>
@endif

@endsection