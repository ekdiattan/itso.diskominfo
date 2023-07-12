@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Master Pegawai</h2>
</div>
<section class="content">
    <div class="container-fluid">
          @if(session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
          @endif
          @if(session('conflict'))
          <div class="alert alert-warning" role="alert">
              {{ session('conflict') }}
          </div>
          @endif
          @if($conflict)
          <div class="alert alert-primary" role="alert">
              <p>Terdapat data yang harus ditinjau ulang</p>
              <a href="/pegawai-conflict">Klik disini untuk meninjau ulang data</a>
          </div>
          @endif
        <div class="row">
          <div class="col-12">
          <div id="example1_wrapper" class="dataTables_wrapper dt_bootstrap4">
          <div class="card">
          <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
            <!-- Container wrapper -->
            <div class="container justify-content-center justify-content-md-between">
            <!-- Left links -->
                <ul class="navbar-nav flex-row">
                    <li class="nav-item me-auto">
                    <a class="nav-link" href="/master-pegawai" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                        class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                        Semua Pegawai
                    </a>
                    </li>
                    <li class="nav-item me-auto">
                    <a class="nav-link" href="/pns" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                        class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                        PNS
                    </a>
                    </li>
                    <li class="nav-item me-auto">
                    <a class="nav-link" href="#" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                        class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                        <b>Non-PNS</b>
                    </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item me-auto">
                        <a class="nav-link text-success" href="/tambah-data-pegawai" style="font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                            <b>+ Data Pegawai</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
            <div class="card-body">
            <a href="/pegawai-sync" class="button btn btn-success mb-3">Update Data</a>
            <!-- <h5>Filter Data Berdasarkan</h5> -->
            <form id="filterSelect" action="/nonpns" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <select name="include" class="form-select" aria-label="Default select example" onChange="document.getElementById('filterSelect').submit()">
                            <option selected value="include" @if($before != null) {{ $before['include'] == 'include' ? 'selected' : '' }} @endif>Termasuk</option>
                            <option value="notInclude" @if($before != null) {{ $before['include'] == 'notInclude' ? 'selected' : '' }} @endif>Selain</option>
                        </select>
                </div>
                <div class="col-md-3">
                        <select name="unitkerja" class="form-select" aria-label="Default select example" onChange="document.getElementById('filterSelect').submit()">
                            <option selected value="">Semua Unit Kerja</option>
                            @foreach($unitkerjas as $unitkerja)
                            <option value="{{ $unitkerja['namaUnit'] }}" @if($before != null) {{ $before['unitkerja'] == $unitkerja['namaUnit'] ? 'selected' : '' }} @endif>{{ $unitkerja['namaUnit'] }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-3">
                        <select name="divisi" class="form-select" aria-label="Default select example" onChange="document.getElementById('filterSelect').submit()">
                            <option selected value="">Semua Divisi</option>
                            @foreach($divisis as $divisi)
                            <option value="{{ $divisi['idUnitKerja'] }}" @if($before != null) {{ $before['divisi'] == $divisi['idUnitKerja'] ? 'selected' : '' }} @endif>{{ $divisi['unitKerjaApi'] }}</option>
                            @endforeach
                        </select>
                </div>
                </div>
            </form>

            <!-- <a href="/update-data-pegawai" class="btn btn-info bg-maroon" title="Sync Data"><i class="fa fa-file-pdf-o"></i> Sync Data</a>      -->
                <div id="dataTable_wrapper" class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                   
                 </nav>
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">                          
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="25%" class="text-center">Nama</th>
                                <th class="text-center">Tempat Lahir</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Unit Kerja</th>
                                <th class="text-center">Divisi</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Pendidikan</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">TMT Masuk Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr onClick="window.location='/detail-nonpns/{{ $item->id }}'">
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td class="text-left">{{ $item->fullname }}</td>
                                <td class="text-left">{{ $item->birth_place }}</td>
                                <td class="text-left">{{ $item->birth_date }}</td>
                                <td class="text-left">{{ $item->unitKerja->aliasUnit }}</td>
                                <td class="text-left">{{ $item->divisi }}</td>
                                <td class="text-left">{{ $item->jabatan }}</td>
                                <td class="text-left">@if($item->pendidikan != null){{ $item->pendidikan->educational_level }}@endif</td>
                                <td class="text-left">@if($item->pendidikan != null){{ $item->pendidikan->majors }}@endif</td>
                                <td class="text-left">{{ $item->join_date }}</td>
                                <!-- <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-social btn-flat btn-info btn-xs" data-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-arrow-circle-down"></i> Pilih Aksi
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('data-pegawai/detail-pegawai/' . $item->id) }}" class="btn btn-social btn-flat btn-block btn-xs"><i
                                                    class="fa fa-list-ol"></i>Lihat Detail</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('edit-pegawai/'. $item->id) }}" class="btn btn-social btn-flat btn-block btn-xs"><i
                                                    class="fa fa-edit"></i>Ubah Data</a>
                                            </li>
                                            <li>
                                                <a href="#" class="btn btn-social btn-flat btn-block btn-xs"data-toggle="modal" data-target="#modal-danger{{ $item->id }}"><i
                                                    class="fa fa-trash"></i>Hapus Data</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td> -->
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- danger modal --}}
    @foreach ($data as $item)
        <div class="modal modal-danger fade" id="modal-danger{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/delete' . $item->id) }}" method="GET">
                            {{ csrf_field() }}
                            <p>Yakin ingin menghapus data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
</div>
</div>
@endsection

@push('scripts')
    <!-- <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                stateSave: true,
                buttons: [
                    'colvis'
                ]
            });
        });
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.js"></script> -->
@endpush
