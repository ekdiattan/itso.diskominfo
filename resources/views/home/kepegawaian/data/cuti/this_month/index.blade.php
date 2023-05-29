@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
    <div class="box box-info">
        <div class="box-header with-border">
            <a href="pdf_cuti" target="_blank" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-file-excel-o"></i>
                Export PDF</a>
            <a href="store-cuti" class="btn btn-success btn-xs btn-flat"></i> Update Data</a>
        </div>
        <div class="box-header with-border form-inline">
            <div class="row">
                <div class="col-sm-2">
                    <select class="form-control input-sm select2 select2-hidden-accessible" id="status" name="status"
                        data-select2-id="status" tabindex="-1" aria-hidden="true">
                        <option value="1" href="/cuti">Semua Data</option>
                        <option value="2" selected href="/sedang-cuti">Sedang Cuti</option>
                    </select>
                    <script>
                        document.getElementById('status').onchange = function() {
                            window.location.href = this.children[this.selectedIndex].getAttribute('href');
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="table-responsive table-min-height" style="padding-bottom: 0px">
                        <div class="box-body">
                            <table id="myTable" class="table table-stiped table-bordered ">
                                <thead class="bg-gray disabled color-palette">
                                    <tr>
                                        <th style="vertical-align:middle;">No</th>
                                        <th style="vertical-align:middle;">Nama</th>
                                        <th style="vertical-align:middle;">Jabatan</th>
                                        <th style="vertical-align:middle;">Unit Kerja</th>
                                        <th style="vertical-align:middle;">Jenis Cuti</th>
                                        <th width="8%">Tanggal Mulai</th>
                                        <th width="8%">Tanggal Selesai</th>
                                        <th style="vertical-align:middle;">Uraian</th>
                                        <th style="vertical-align:middle;">Tanggal Pengajuan</th>
                                        <th style="vertical-align:middle;">Atasan</th>
                                        <th width="10%" style="vertical-align:middle;">Ket Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach ($data_cuti as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->njab }}</td>
                                            <td>{{ $item->unitkerja_nama }}</td>
                                            <td>{{ $item->jenis_cuti }}</td>
                                            <td>{{ $item->tgl_mulai }}</td>
                                            <td>{{ $item->tgl_selesai }}</td>
                                            <td>{{ $item->uraian }}</td>
                                            <td>{{ $item->tgl_pengajuan }}</td>
                                            <td>{{ $item->atasan }}</td>
                                            <td>{{ $item->ket_proses }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                stateSave: true
            });
        });
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.js"></script>
@endpush
