@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')

@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Catatan IT</h2>
  </div>
<a class="btn btn-success" style="margin-left:10px;" href="/laporan/create">+ Create New</a>
    <div class="col-lg-12 grid-margin stretch-card">
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><b>Belum Selesai</b></h4>
                <div class="table-responsive">
                <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Tiket</th>
                                <th>Tanggal Catatan</th>
                                <th>Permasalahan</th>
                                <th>Nama Pelapor</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($belum as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->tiket }}</td>
                                    <td>{{ $post->tanggalmencatat }}</td>
                                    <td>{{ $post->permasalahan }}</td>
                                    <td>{{ $post->namapelapor }}</td>
                                    <td>{{ $post->kategori }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>
                                        <a href="/laporan/{{ $post->id }}" class="badge bg-info"><span class="menu-icon"><i class="far fa-eye"></i></span></a>
                                        <a href="{{ url('laporan-execute/'.$post->id) }}" class="badge bg-primary"><span class="menu-icon"><i class="fas fa-tools"></i></span></a>
                                        <!-- hanya menyediakan fitur untuk pencatat saja -->
                                        @if($post->namapencatat == auth()->user()->nama || auth()->user()->hak_akses == "Admin")
                                        <a href="{{ url('laporan-edit/'.$post->id) }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                                        @endif
                                        <form action="/laporan-delete/{{ $post->id }}" method="get" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure?')"><span class="menu-icon"><i
                                                        class="fas fa-trash"></i></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><b>Selesai</b></h4>
                <div class="table-responsive">
                    <table id="dataTable2" class="table table-hover table-bordered table-striped">
                        <thead  class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Tiket</th>
                                <th>Tanggal Catatan</th>
                                <th>Permasalahan</th>
                                <th>Nama Pelapor</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selesai as $post)
                                <tr>    
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->tiket }}</td>
                                    <td>{{ $post->tanggalmencatat }}</td>
                                    <td>{{ $post->permasalahan }}</td>
                                    <td>{{ $post->namapelapor }}</td>
                                    <td>{{ $post->kategori }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>{{ $post->tanggalselesai }}</td>
                                    <td>
                                        <a href="/laporan/{{ $post->id }}" class="badge bg-info"><span
                                                class="menu-icon"><i class="far fa-eye"></i></span></a>
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