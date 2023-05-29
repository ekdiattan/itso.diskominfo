@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Master Pegawai</h2>
</div>

<div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
    <!-- Container wrapper -->
    <div class="container justify-content-center justify-content-md-between">
      <!-- Left links -->
      <ul class="navbar-nav flex-row">
        <li class="nav-item me-auto">
          <a class="nav-link" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            Tampilkan Data Berdasarkan
          </a>
        </li>
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
          <a class="nav-link" href="/nonpns" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
            <b>Non-PNS</b>
          </a>
        </li>
        <div style="display: flex; justify-content: flex-end">
            <li class="nav-item me-auto">
                <a class="nav-link text-success" href="/tambah-data-pegawai" style="font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                    class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                    <b>+ Data Pegawai</b>
                </a>
            </li>
        </div>
      </ul>
    </div>
</div>
<br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div id="example1_wrapper" class="dataTables_wrapper dt_bootstrap4">
          <div class="card">
            <div class="card-body">
            <!-- <a href="/update-data-pegawai" class="btn btn-info bg-maroon" title="Sync Data"><i class="fa fa-file-pdf-o"></i> Sync Data</a>      -->
                <div id="dataTable_wrapper" class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                   
                 </nav>
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">                          
                            <tr>
                                <th width="5%" style="text-align: center">No</th>
                                <th width="25%" style="text-align: center">Nama</th>
                                <th style="text-align: center">Tempat Lahir</th>
                                <th style="text-align: center">Tanggal Lahir</th>
                                <th style="text-align: center">NIP</th>
                                <th style="text-align: center">Unit Kerja</th>
                                <th style="text-align: center">Golongan Pangkat</th>
                                <th style="text-align: center">TMT Golongan</th>
                                <th style="text-align: center">Eselon</th>
                                <th style="text-align: center">Nama Jabatan</th>
                                <th style="text-align: center">TMT Jabatan</th>
                                <th style="text-align: center">Status Pegawai</th>
                                <th style="text-align: center">TMT Pegawai</th>
                                <th style="text-align: center">Masa Kerja Tahun</th>
                                <th style="text-align: center">Masa Kerja Bulan</th>
                                <th style="text-align: center">Jenis Kelamin</th>
                                <th style="text-align: center">Agama</th>
                                <th style="text-align: center">Perkawinan</th>
                                <th style="text-align: center">Pendidikan Awal</th>
                                <th style="text-align: center">Jurusan Pendidikan Awal</th>
                                <th style="text-align: center">Pendidikan Akhir</th>
                                <th style="text-align: center">Jurusan Pendidikan Akhir</th>
                                <th style="text-align: center">No Askes</th>
                                <th style="text-align: center">No NPWP</th>
                                <th style="text-align: center">NIK</th>
                                <th style="text-align: center">Alamat Rumah</th>
                                <th style="text-align: center">Telpon</th>
                                <th style="text-align: center">No Handphone</th>
                                <th style="text-align: center">E-mail</th>
                                <th style="text-align: center">Kedudukan Pegawai</th>
                                <th width="5%" style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <!-- @php $i=1 @endphp -->
                        @foreach ($data as $item)
                            <tr>
                                @if($search == null)
                                <td>{{ $loop->iteration}}</td>
                                @else
                                <td>{{ $loop->iteration }}</td>
                                @endif
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tempatLahir }}</td>
                                <td>{{ $item->tanggalLahir }}</td>
                                <td>{{ $item->noPegawai }}</td>
                                <td>{{ $item->unitKerja }}</td>
                                <td>{{ $item->golonganPangkat }}</td>
                                <td>{{ $item->tmtGolongan }}</td>
                                <td>{{ $item->eselon }}</td>
                                <td>{{ $item->namaJabatan }}</td>
                                <td>{{ $item->tmtJabatan }}</td>
                                <td>{{ $item->statusPegawai }}</td>
                                <td>{{ $item->tmtPegawai }}</td>
                                <td>{{ $item->masaKerjaTahun }}</td>
                                <td>{{ $item->masaKerjaBulan }}</td>
                                <td>{{ $item->jenisKelamin }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->perkawinan }}</td>
                                <td>{{ $item->pendidikanAwal }}</td>
                                <td>{{ $item->jurusanPendidikanAwal }}</td>
                                <td>{{ $item->pendidikanAkhir }}</td>
                                <td>{{ $item->jurusanPendidikanAkhir }}</td>
                                <td>{{ $item->noAkses }}</td>
                                <td>{{ $item->noNpwp }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->alamatRumah }}</td>
                                <td>{{ $item->telp }}</td>
                                <td>{{ $item->hp }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->kedudukanPegawai }}</td>
                                <td>
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
                                </td>
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
