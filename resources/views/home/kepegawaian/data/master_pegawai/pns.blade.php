@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
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
                    <a class="nav-link" href="#" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                        class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                        <b>PNS</b>
                    </a>
                    </li>
                    <li class="nav-item me-auto">
                    <a class="nav-link" href="/nonpns" style="color:black;font-size:18px;" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
                        class="btn shadow-0 p-0 me-auto" aria-controls="#sidenav-1" aria-haspopup="true">
                        Non-PNS
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
            <a href="/pegawai-sync" class="button btn btn-success">Update Data</a>
                <div id="dataTable_wrapper" class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                   
                 </nav>
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">                          
                            <tr>
                                <th width="5%" class="text-left">No</th>
                                <th width="25%" class="text-left">Nama</th>
                                <th class="text-left">Tempat Lahir</th>
                                <th class="text-left">Tanggal Lahir</th>
                                <th class="text-left">NIP</th>
                                <th class="text-left">Unit Kerja</th>
                                <!--<th class="text-left">Golongan Pangkat</th>
                                <th class="text-left">TMT Golongan</th>
                                <th class="text-left">Eselon</th>
                                <th class="text-left">Nama Jabatan</th>
                                <th class="text-left">TMT Jabatan</th>
                                <th class="text-left">Status Pegawai</th>
                                <th class="text-left">TMT Pegawai</th>
                                <th class="text-left">Masa Kerja Tahun</th>
                                <th class="text-left">Masa Kerja Bulan</th>
                                <th class="text-left">Jenis Kelamin</th>
                                <th class="text-left">Agama</th>
                                <th class="text-left">Perkawinan</th>
                                <th class="text-left">Pendidikan Awal</th>
                                <th class="text-left">Jurusan Pendidikan Awal</th>
                                <th class="text-left">Pendidikan Akhir</th>
                                <th class="text-left">Jurusan Pendidikan Akhir</th>
                                <th class="text-left">No Askes</th>
                                <th class="text-left">No NPWP</th>
                                <th class="text-left">NIK</th>
                                <th class="text-left">Alamat Rumah</th>
                                <th class="text-left">Telpon</th>
                                <th class="text-left">No Handphone</th>
                                <th class="text-left">E-mail</th>
                                <th class="text-left">Kedudukan Pegawai</th>-->
                            </tr>
                        </thead>
                        <tbody>
                             <!-- @php $i=1 @endphp -->
                        @foreach ($data as $item)
                            <tr onClick="window.location='/detail-pegawai/{{ $item->id }}'">
                                @if($search == null)
                                <td>{{ $loop->iteration}}</td>
                                @else
                                <td>{{ $loop->iteration }}</td>
                                @endif
                                <td class="text-left">{{ $item->nama }}</td>
                                <td class="text-left">{{ $item->tempatLahir }}</td>
                                <td class="text-left">{{ $item->tanggalLahir }}</td>
                                <td class="text-left">{{ $item->noPegawai }}</td>
                                <td class="text-left">{{ $item->unitKerja }}</td>
                                <!--<td class="text-left">{{ $item->golonganPangkat }}</td>
                                <td class="text-left">{{ $item->tmtGolongan }}</td>
                                <td class="text-left">{{ $item->eselon }}</td>
                                <td class="text-left">{{ $item->namaJabatan }}</td>
                                <td class="text-left">{{ $item->tmtJabatan }}</td>
                                <td class="text-left">{{ $item->statusPegawai }}</td>
                                <td class="text-left">{{ $item->tmtPegawai }}</td>
                                <td class="text-left">{{ $item->masaKerjaTahun }}</td>
                                <td class="text-left">{{ $item->masaKerjaBulan }}</td>
                                <td class="text-left">{{ $item->jenisKelamin }}</td>
                                <td class="text-left">{{ $item->agama }}</td>
                                <td class="text-left">{{ $item->perkawinan }}</td>
                                <td class="text-left">{{ $item->pendidikanAwal }}</td>
                                <td class="text-left">{{ $item->jurusanPendidikanAwal }}</td>
                                <td class="text-left">{{ $item->pendidikanAkhir }}</td>
                                <td class="text-left">{{ $item->jurusanPendidikanAkhir }}</td>
                                <td class="text-left">{{ $item->noAkses }}</td>
                                <td class="text-left">{{ $item->noNpwp }}</td>
                                <td class="text-left">{{ $item->nik }}</td>
                                <td class="text-left">{{ $item->alamatRumah }}</td>
                                <td class="text-left">{{ $item->telp }}</td>
                                <td class="text-left">{{ $item->hp }}</td>
                                <td class="text-left">{{ $item->email }}</td>
                                <td class="text-left">{{ $item->kedudukanPegawai }}</td>-->
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
