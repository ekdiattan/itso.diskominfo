<link rel="stylesheet" href="assets/css/maintenance.css">
@extends('home.partials.public')
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="">
  </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt= "Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Mohon maaf untuk website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat sedang dalam perbaikan, dimohon untuk menunggu beberapa saat, terimakasih.<img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>
<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a href="/maintenance" class="navbar-brand">
        <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 44px; width: 160px; margin-left: 25px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="https://diskominfo.jabarprov.go.id/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/dashboard">Kembali ke website ITSO</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<br>
<br>
<br>
<div>
    <img src="{{ asset('assets/images/maintenance.svg') }}" alt="Diskominfo" id="fotodiskominfo"> 
</div>
</div>
@endsection
