@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Peminjaman Aset</h2>
</div>

<!-- double navbar -->
<div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
    <!-- Container wrapper -->
    <div class="container justify-content-center justify-content-md-between">
      <!-- Left links -->
      <ul class="navbar-nav flex-row">
        <li class="nav-item me-auto">
          <a class="nav-link" href="/booking-reject" style="color:red;font-size:20px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            Ditolak
          </a>
        </li>
        <li class="nav-item me-auto">
          <a class="nav-link" href="/booking-acc" style="color:green;font-size:20px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            Disetujui
          </a>
        </li>
        <li class="nav-item me-auto">
          <a class="nav-link" href="/booking-selesai" style="color:blue;font-size:20px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            Selesai
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item me-auto">
            <a class="nav-link text-success" href="/booking/create" style="font-size:20px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                +Create New
            </a>
        </li>
      </ul>
    </div>
</div>
<br>
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="col-lg-12 grid-margin stretch-card">
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><b>Permohonan</b></h4>
                <div class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                    <!-- <form action="#" method="GET">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Masukan Nama Pemohon" aria-label="Search" name="search" value="">
                        </form>
                    <a href="#" class="btn btn-danger" role="button">Reset</a> -->
                    </form>
                 </nav>
                <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Tiket</th>
                                <th>Nama Pemohon</th>
                                <th>No Hp</th>
                                <th>Bidang</th>
                                <th>Perihal</th>
                                <th>Tanggal Permohonan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dalamPengajuan != null)
                            @foreach ($dalamPengajuan as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->tiket }}</td>
                                    <td>{{ $post->namaPemohon }}</td>
                                    <td>{{ $post->noTelp }}</td>
                                    <td>{{ $post->getBidang->namaUnit }}</td>
                                    <td>{{ $post->perihal }}</td>
                                    <td>{{ $post->tanggalPermohonan }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>
                                        <a href="/booking/{{ $post->id }}" class="badge bg-info"><span class="menu-icon"><i class="far fa-eye"></i></span></a>
                                        <a href="/booking-edit/{{ $post->id }}" class="badge bg-primary"><span class="menu-icon"><i class="fas fa-tools"></i></span></a>
                                        <!-- <a href="#" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a> -->
                                        <form action="/booking/delete/{{ $post->id }}" method="get" class="d-inline">
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure?')"><span class="menu-icon"><i
                                                        class="fas fa-trash"></i></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="color:green;"><b>Disetujui</b></h4>
                <div class="table-responsive">
                    <nav class="navbar bg-body-tertiary">
                        <!-- <form action="#" method="GET">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search2" placeholder="Masukan Nama Pemohon" aria-label="search2" name="search2" value="">
                            </form>
                            <a href="#" class="btn btn-danger" role="button">Reset</a> -->
                        </form>
                    </nav>
                    <table id="dataTable2" class="table table-hover table-bordered table-striped">
                        <thead  class="bg-gray disabled color-palette">
                            <tr>
                            <th>No</th>
                                <th>Tiket</th>
                                <th>Nama Pemohon</th>
                                <th>No Hp</th>
                                <th>Bidang</th>
                                <th>Perihal</th>
                                <th>Tanggal Permohonan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disetujui as $post)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->tiket }}</td>
                                    <td>{{ $post->namaPemohon }}</td>
                                    <td>{{ $post->noTelp }}</td>
                                    <td>{{ $post->getBidang->namaUnit }}</td>
                                    <td>{{ $post->perihal }}</td>
                                    <td>{{ $post->tanggalPermohonan }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>
                                    <a href="/booking/{{ $post->id }}" class="badge bg-info"><span class="menu-icon"><i class="far fa-eye"></i></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection
