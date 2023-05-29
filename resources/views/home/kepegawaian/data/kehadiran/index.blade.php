@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3">
    <h2>{{ $title }}</h2>
</div>
  
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div id="example1_wrapper" class="dataTables_wrapper dt_bootstrap4">
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success" role="alert">
            {{ session('success') }}
            </div>
            @endif
            <div class="card">
            <div class="card-body">
                <a class="btn btn-success" role="button" href="pdf_kehadiran">Export PDF</a>
                <a class="btn btn-primary" role="button" href="/store/kehadiran">Update Data</a>
                <div class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                    <form action="/kepegawaian/kehadiran" method="GET">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $search }}">
                        </form>
                    <a href="/kepegawaian/kehadiran" class="btn btn-danger" role="button">Reset</a>
                    </form>
                 </nav>
                    <table id="example1" class="table table-hover table-bordered table-striped" style="font-size:16px;">
                        <thead class="bg-gray disabled color-palette">       <tr>
                                <th class="text-justify">No</th>
                                <th class="text-justify">Nama</th>
                                <th class="text-justify">Unit Kerja</th>
                                <th class="text-justify">Masuk</th>
                                <th class="text-justify">Pulang</th>
                                <th class="text-justify">Terlambat<br>(detik)</th>
                                <th class="text-justify">Tanggal</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_post as $item)
                            <tr>
                                <td class="text-justify">{{ $loop->iteration }}</td>
                                <td class="text-justify">{{ $item->nama }}</td>
                                <td class="text-justify">{{ $item->unitkerja }}</td>
                                <td class="text-justify">{{ $item->masuk }}</td>
                                <td class="text-justify">{{ $item->pulang }}</td>
                                <td class="text-justify">{{ $item->terlambat }}</td>
                                <td class="text-justify">{{ $item->tanggal }}</td>
                                </tr>
                            @endforeach
                        </tbody>      
                </table>
            </div>
        </div>
    </div>
@endsection
<style>
    .table {
        font-size: 9px;
    }
</style>

