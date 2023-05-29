@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Riwayat Peminjaman</h2>
</div>
<div class="row">
    <div class="cols">
        <a class="btn btn-warning" style="margin-left:10px;" href="/keamanan">Kembali</a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><b>Riwayat Peminjaman</b></h4>
        <div id="dataTable_wrapper" class="table-responsive">
            <nav class="navbar bg-body-tertiary">
                <form action="#" method="GET">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Masukan Nama Pemohon" aria-label="Search" name="search" value="">
                        </form>
                    <a href="#" class="btn btn-danger" role="button">Reset</a>
                </form>
            </nav>
                <table id="dataTable" class="table table-hover table-bordered table-striped">
                    <thead class="bg-gray disabled color-palette">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Bidang</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($selesai != null)
                        @foreach ($selesai as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->namaPemohon }}</td>
                                <td>{{ $post->bidang }}</td>
                                <td>{{ $post->tanggalPermohonan }}</td>
                                <td>
                                    <a href="/keamanan-riwayatdetail/{{ $post->id }}" class="badge bg-info"><span class="menu-icon"><i class="far fa-eye"></i></span></a>
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
@endsection