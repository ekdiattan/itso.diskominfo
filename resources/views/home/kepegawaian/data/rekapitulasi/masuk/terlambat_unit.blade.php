@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

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
                        <div class="box-header with-border">
                            <a href="/store/terlambat-masuk-unit" class="btn btn-primary">Update Data</a>
                            <br><br>
                            <div class="box-header with-border form-inline">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select class="form-control input-sm select2 select2-hidden-accessible" id="status"
                                            name="status" data-select2-id="status" tabindex="-1" aria-hidden="true">
                                            <option value="1" href="/rekap/terlambat-masuk">Rekapitulasi Terlambat Masuk PNS
                                            </option>
                                            <option value="2" selected href="/rekap/terlambat-masuk-unit">Rekapitulasi Terlambat Masuk Unit
                                            </option>
                                            <option value="3" href="/rekap/tidak-absen-pulang">Rekapitulasi Tidak Absen Pulang PNS
                                            </option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Masukan Tanggal Mulai</label>
                                        <div class="col-sm-9">
                                            <form action="/rekap/terlambat-masuk-unit" method="get" id="filterDate">
                                                <input class="form-control" type="date" id="date" name="date" data-select2-id="date" tabindex="-1" aria-hidden="true" onChange="dateFilter()" value="{{ $date }}">
                                                <a href="/rekap/terlambat-masuk-unit" class="btn btn-danger" role="button">Reset</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <br>
                        <div class="box-body">
                            <section class="table-sm table-responsive">
                                <table id="myTable" class="table">
                                    <thead class="bg-gray disabled color-palette">
                                        <tr>
                                            <th rowspan="2" style="text-align: center; vertical-align:middle" width="5%">
                                                Total</th>
                                            <th style="text-align: center; vertical-align:middle">Unit Kerja</th>
                                            <th rowspan="2" style="text-align: center; vertical-align:middle">Jumlah Pegawai <br>
                                                (Orang) </th>
                                            <th rowspan="2" style="text-align: center; vertical-align:middle">Waktu <br>
                                                Keterlambatan <br> (Detik)
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach ($unit as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $data->unitkerja }}</td>
                                                <td>{{ $data->sum_nama }}</td>
                                                <td>{{ number_format($data->sum_score) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
@endpush
