@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
@endpush

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


@section('container')
<div class="col-lg-12 grid-margin stretch-card">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <a href="/store/tidak-absen-pulang" class="btn btn-primary" role="button"></i> Update Data</a>
                        <div class="box-header with-border">
                            <div class="box-header with-border form-inline">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select class="form-control input-sm select2 select2-hidden-accessible" id="status"
                                            name="status" data-select2-id="status" tabindex="-1" aria-hidden="true">
                                            <option value="1" href="/rekap/terlambat-masuk">Rekapitulasi Terlambat Masuk PNS
                                            </option>
                                            <option value="1" href="/rekap/terlambat-masuk-unit">Rekapitulasi Terlambat Masuk Unit
                                            </option>
                                            <option value="1" selected href="/rekap/tidak-absen-pulang">Rekapitulasi Tidak Absen Pulang PNS
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Masukan Tanggal Mulai</label>
                                        <div class="col-sm-9">
                                            <form action="/rekap/tidak-absen-pulang" method="get" id="filterDate">
                                                <input class="form-control input-sm" type="date" id="tanggal" name="tanggal" data-select2-id="tanggal" tabindex="-1" aria-hidden="true" value="{{ $date }}" onChange="dateFilter()">
                                                <a href="/rekap/tidak-absen-pulang" style="margin-left: 5px; color: red;">Reset</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @csrf
                        <div class="box-body">
                            <section class="table-responsive">
                                <div class="dataTables_wrapper for m-inline dt-bootstrap no-footer">
                                    <div class="table-responsive table-min-height" style="padding-bottom: 0px">
                                        <div class="box-body">
                                            <table id="myTable" class="table table-bordered table-contextual">
                                                <thead class="bg-gray disabled color-palette">
                                                    <tr>
                                                        <th rowspan="3" style="vertical-align:middle" width="5%">No</th>
                                                        <th rowspan="3" style="vertical-align:middle" width="25%">Nama</th>
                                                        <th rowspan="3" style="vertical-align:middle">Unit Kerja</th>
                                                        <th colspan="5" style="vertical-align:middle">Hari (dalam detik)</th>
                                                    </tr>
                                                    <tr>
                                                        <td style='text-align:center; font-weight:bold;'>{{ $days->format('l') }}</td>
                                                        <td style='text-align:center; font-weight:bold;'>{{ $days->addDays(1)->format('l') }}</td>
                                                        <td style='text-align:center; font-weight:bold;'>{{ $days->addDays(1)->format('l') }}</td>
                                                        <td style='text-align:center; font-weight:bold;'>{{ $days->addDays(1)->format('l') }}</td>
                                                        <td style='text-align:center; font-weight:bold;'>{{ $days->addDays(1)->format('l') }}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i=1 @endphp
                                                    @foreach($pulangs as $pulang)
                                                        @if($pulang['monday'] != 0 || $pulang['tuesday'] != 0 || $pulang['wednesday'] != 0 || $pulang['thursday'] != 0 || $pulang['friday'] != 0)
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>{{ $pulang['nama'] }}</td>
                                                                <td>{{ $pulang['unitkerja_nama'] }}</td>
                                                                <td>@if($pulang['monday'])&#10003;@endif</td>
                                                                <td>@if($pulang['tuesday'])&#10003;@endif</td>
                                                                <td>@if($pulang['wednesday'])&#10003;@endif</td>
                                                                <td>@if($pulang['thursday'])&#10003;@endif</td>
                                                                <td>@if($pulang['friday'])&#10003;@endif</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

    <script>
        document.getElementById('status').onchange = function() {
        window.location.href = this.children[this.selectedIndex].getAttribute('href');
        }
        
        function dateFilter(){
            document.getElementById('filterDate').submit();
        }
    </script>
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
