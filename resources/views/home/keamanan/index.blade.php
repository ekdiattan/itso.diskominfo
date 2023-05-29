@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Peminjaman Kendaraan</h2>
</div>
<!-- double navbar -->
<div class="nav navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Container wrapper -->
    <div class="container justify-content-center justify-content-md-between">
      <!-- Left links -->
      <ul class="navbar-nav flex-row">
        <li class="nav-item me-auto">
          <a href="/keamanan-riwayat" class="nav-link" style="font-size:20px;color:blue" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            Riwayat Peminjaman
          </a>
        </li>
      </ul>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1" style="color:orange"><b>Kendaraan yang akan dipinjam</b></h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <div id="dataTable_wrapper" class="table-responsive">
                                <table id="dataTable" class="table table-hover table-bordered table-striped">
                                    <thead  class="bg-gray disabled color-palette">
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjam</th>
                                            <th>Bidang</th>
                                            <th>Tanggal Pinjam</th>
                                        </tr>
                                    </thead>
                                    @if($disetujui != null)
                                    @foreach ($disetujui as $post)
                                    @if($post->aset->jenis == 'Kendaraan')
                                    <tr onClick="window.location='/keamanan/{{ $post->id }}'">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->namaPemohon }}</td>
                                        <td>{{ $post->bidang }}</td>
                                        <td>{{ $post->mulai }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1" style="color:green"><b>Kendaraan yang sedang dipinjam</b></h4>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <div id="dataTable2_wrapper" class="table-responsive">
                                <table id="dataTable2" class="table table-hover table-bordered table-striped">
                                    <thead  class="bg-gray disabled color-palette">
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjam</th>
                                            <th>Bidang</th>
                                            <th>Tanggal Selesai</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($dipinjam != null)
                                    @foreach ($dipinjam as $post)
                                    @if($post->aset->jenis == 'Kendaraan')
                                        <tr onClick="window.location='/keamanan/{{ $post->id }}'">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->namaPemohon }}</td>
                                            <td>{{ $post->bidang }}</td>
                                            <td>{{ $post->mulai }}</td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection