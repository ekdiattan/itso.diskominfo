@extends('home.partials.public')
<link rel="shortcut icon" href="{{ asset('assets/images/jabar.png') }}">
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>

<div class="col-lg-12 grid-margin stretch-card px-3 py-3">
  @section('container')
  @if(session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
  @endif
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><b>Detail Permohonan</b></h4>
      <p class="card-text bg-warning">Mohon untuk menyimpan No. Tiket, karena dapat digunakan untuk melakukan pengecekan status peminjaman</p>
      <table class="table table-borderless table-light">
        <thead class="disabled">
          <tr>
            <td>No. Tiket</td>
            <td>{{ $data->tiket }}</td>
          </tr>
          <tr>
            <td>Pemohon</td>
            <td>{{ $data->namaPemohon }}</td>
          </tr>
          <!-- <tr>
            <td>Nip</td>
            <td>{{ $data->nip }}</td>
          </tr> -->
          <tr>
            <td>No. Whatsapp</td>
            <td>{{ $data->noTelp }}</td>
          </tr>
          <tr>
            <td>Bidang</td>
            <td>{{ $data->getBidang->aliasUnit }}</td>
          </tr>
          <tr>
            <td>Mulai</td>
            <td>{{ $data->mulai }}</td>
          </tr>
          <tr>
            <td>Selesai</td>
            <td>{{ $data->selesai }}</td>
          </tr>
          <tr>
            <td>Keperluan</td>
            <td>{{ $data->keperluan }}</td>
          </tr>
          <tr>
            <td>Perihal</td>
            <td>{{ $data->perihal }}</td>
          </tr>
          <tr>
            <td>Surat Permohonan</td>
            <td> <a href="/booking-export/{{$data->id}}">Cetak Surat </a> </td>
          </tr>
          <tr>
            <td>Tanggal Permohonan</td>
            <td>{{ $data->tanggalPermohonan }}</td>
          </tr>
          <tr>
            <td>Status Peminjaman</td>
            <td>{{ $data->status }}</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <a class="btn btn-danger" href="/public" role="button">Kembali</a>
  <a class="btn btn-success" href="/tracking/{{$data->tiket}}" role="button" target="_blank">Ke Tracking</a>

</div>
@endsection
