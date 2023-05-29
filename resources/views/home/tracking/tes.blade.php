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
<br>
<br>
<div class="wrapper">
  <div class="row">
    <div class="card mx-auto" style="width:350px;height: 220px;" id="box1" >
      <div class="card-body">
        <h5 class="card-body text-center">Permohonan Peminjaman Aset</h5>
        </div>
        <a href="/peminjaman/" class="btn btn-danger">Ajukan Peminjaman</a>
      </div>
    </div>
    <div class="row">
      <div class="card mx-auto" style="width:350px;height: 250px;" id="box1">
        <div class="card-body">
          <h5 class="card-body text-center">Cek Status Peminjaman Anda Disini</h5>
      </div>
      <a href="/tracking" class="btn btn-primary">Cek Status</a>
    </div>
    <div class="card mx-auto" style="width:350px;height: 220px;" id="box1">
      <div class="card-body">
        <h5 class="card-body text-center">Cek Jadwal Peminjaman</h5>
    </div>
    <a href="#" class="btn btn-success">Cek Jadwal</a>
  </div>
</div>

@endsection