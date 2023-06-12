<link rel="stylesheet" href="assets/css/public.css">
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@extends('home.partials.public')
<nav class="navbar bg-info sticky-top">
  <div class="container-fluid sticky-top">
    <marquee direction="left" height="50px"><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat, Alamat: Jl. Tamansari No.55, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132 <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>
<video autoplay muted loop id="myVideo" >
  <source src="/assets/videos/diskominfobaru.mp4" type="video/mp4">
  </video>
  @section('container')

<br>
<br>
<div class="wrapper">
  <div class="row">
    <div class="card mx-auto" style="width:375px;height: 250px;" id="box1" >
      <div class="card-body">
        <h5 class="card-body text-center">Menu Laporan Permasalahan</h5>
        <p class="card-text">Laporkan permasalahan yang berkaitan dengan IT atau melihat progress dari permasalahan yang sebelumnya dilaporkan</p>
        </div>
        <a href="/laporPermasalahan/" class="btn btn-primary">Laporan Permasalahan</a>
      </div>
    </div>
    <div class="row">
      <div class="card mx-auto" style="width:375px;height: 250px;" id="box1">
        <div class="card-body">
          <h5 class="card-body text-center">Menu Booking</h5>
          <p class="card-text">Menu yang memungkinkan Anda untuk permohonan peminjaman barang kepada Tim Aset atau melihat status dari permohonan yang dilakukan sebelumnya</p>
      </div>
      <a href="/pinjam" class="btn btn-primary">Pinjam Barang?</a>
    </div>
  </div>
</div>
@endsection