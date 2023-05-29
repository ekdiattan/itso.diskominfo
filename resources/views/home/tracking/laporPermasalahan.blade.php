<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@extends('home.partials.public')
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <!-- <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 25px;"> -->
  </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>

@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5>Laporan Permasalahan</h5>
</div> 
<br><br>
  <div class="row">
    <!-- <div class="col-md-6">
        <div class="card p-5 mx-auto my-auto" >
        <div class="card-body">
          <h5 class="card-body text-center">Laporkan Permasalahan Anda Disini</h45>
        </div>
        <a href="/lapor/" class="btn btn-danger">Lapor</a>
      </div>
    </div> -->
    <div class="col-md-6">
        <div class="card p-5 mx-auto my-auto" >
          <div class="card-body">
            <h5 class="card-body text-center">Cek Status Laporan Anda Disini</h45>
          </div>
          <a href="/tracking" class="btn btn-success">Cek Status</a>
      </div>
    </div>
  </div>
@endsection