@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Pegawai Tidak Aktif</h2>
</div>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div id="example1_wrapper" class="dataTables_wrapper">
          <div class="card">
            <div class="card-body">
            <!-- <a href="/update-data-pegawai" class="btn btn-info bg-maroon" title="Sync Data"><i class="fa fa-file-pdf-o"></i> Sync Data</a>      -->
                <div id="dataTable_wrapper" class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                   
                 </nav>
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">                          
                            <tr class="text-center">
                                <th width="5%" style="text-align: center">No</th>
                                <th width="25%" style="text-align: center">Nama</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Tanggal Lahir</th>
                                <th style="text-align: center">Divisi</th>
                                <th style="text-align: center">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                             <!-- @php $i=1 @endphp -->
                        @foreach ($data as $item)
                            <tr onClick="window.location='/show-tidakaktif/{{ $item->id }}'">
                                <td class="text-left">{{ $loop->iteration}}</td>
                                <td class="text-left">{{ $item->fullname }}</td>
                                <td class="text-left">{{ $item->email }}</td>
                                <td class="text-left">{{ $item->birth_date }}</td>
                                <td>{{ $item->divisi }}</td>
                                <td class="text-left">{{ $item->jabatan }}</td>
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
