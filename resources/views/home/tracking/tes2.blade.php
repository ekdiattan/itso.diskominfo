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

<div class="row">
	@foreach($booking as $booking)
<div class="col-lg-4 col-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
		<h3 id="count4">0 </h3>
		<p>{{$booking->tiket}}</p>
		</div>
		<div class="icon">
		<i class="ion ion-checkmark"></i>
		</div>
		<a href="/laporan" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
@endforeach
</div>