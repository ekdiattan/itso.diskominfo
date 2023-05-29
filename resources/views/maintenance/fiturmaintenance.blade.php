<link rel="stylesheet" href="assets/css/maintenance.css">
@extends('home.partials.main')
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
      <a href="/dashboard/" class="navbar-brand">
            <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 34px; width: 150px; margin-left: 25px;">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
    </div>
  </div>
</nav>   
<br>
<br>
<br>
<div>
    <img src="{{ asset('assets/images/maintenance3.svg') }}" alt="Diskominfo" id="fotodiskominfo"> 
</div>
</div>
@endsection
