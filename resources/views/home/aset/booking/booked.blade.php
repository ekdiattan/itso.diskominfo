@extends('home.partials.public')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>

@section('container')
<div class="m-3">
    <h2>Aset Dalam Peminjaman</h2>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title"><a href="/permohonan" class="col-form-label btn btn-danger">Kembali</a></h5>
    <div class="table-responsive">
      <nav class="navbar bg-body-tertiary">
        <div class="col-sm-3">
          <label class="col-form-label">Lihat Berdasarkan Tanggal</label>
          <form action="#" method="get" id="filterDate">
            <input class="form-control" type="date" id="tanggal" name="tanggal" data-select2-id="tanggal" tabindex="-1" aria-hidden="true" onChange="dateFilter()" value="#">
          </form>
        </div>
        <a href="/booked" class="btn btn-danger" role="button">Reset</a>
      </nav>
      <h2 class="card-title">Aset : {{ $aset->merk }} {{ $aset->nama }} ({{ $aset->kodeUnit }})</h2>
      <table id="dataTable" class="table table-hover table-bordered table-striped">
          <thead class="bg-gray disabled color-palette">
              <tr>
                  <th>No</th>
                  <th>Tiket</th>
                  <th>Nama Peminjam</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Perihal</th>
              </tr>
          </thead>
          <tbody>
            @foreach($bookeds as $booked)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $booked->tiket }}</td>
                  <td>{{ $booked->namaPemohon }}</td>
                  <td>{{ $booked->mulai }}</td>
                  <td>{{ $booked->selesai }}</td>
                  <td>{{ $booked->perihal }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>

@endsection