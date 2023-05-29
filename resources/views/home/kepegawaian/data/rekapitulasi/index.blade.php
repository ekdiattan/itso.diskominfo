@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
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
            <div class="box-header with-border">
                <a href="/store/terlambat-masuk" class="btn btn-primary" role="button"></i> Update Data</a>
            </div>
            <br>
            <div class="box-header with-border form-inline">
                <div class="row">
                    <div class="col-sm-2">
                        <select class="form-control input-sm select2 select2-hidden-accessible" id="status"
                            name="status" data-select2-id="status" tabindex="-1" aria-hidden="true">
                            <option value="1" selected href="/rekap/terlambat-masuk">Rekapitulasi Terlambat Masuk PNS
                            </option>
                            <option value="1" href="/rekap/terlambat-masuk-unit">Rekapitulasi Terlambat Masuk Unit
                            </option>
                            <option value="1" href="/rekap/tidak-absen-pulang">Rekapitulasi Tidak Absen Pulang PNS
                            </option>
                        </select>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Masukan Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <form action="/rekap/terlambat-masuk" method="get" id="filterDate">
                                    <input class="form-control" type="date" id="tanggal" name="tanggal" data-select2-id="tanggal" tabindex="-1" aria-hidden="true" onChange="dateFilter()" value="{{ $date != null ? $date : $tgl}}">
                                    <a href="/rekap/terlambat-masuk" class="btn btn-danger" role="button">Reset</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>            
            <div class="dataTable_wrapper p-3">
                <table id="dataTable" class="table table-responsive table-bordered table-contextual">
                    <thead class="bg-gray color-palette">
                        <tr>
                            <th rowspan="2" style="vertical-align:middle" width="5%">No</th>
                            <th rowspan="2" style="vertical-align:middle" width="25%">Nama</th>
                            <th rowspan="2" style="vertical-align:middle">Unit Kerja</th>
                            <td colspan="5" style="text-align:center; font-weight:bold;">Hari (dalam detik)</td>
                            <th rowspan="2" style="vertical-align:middle">Jumlah <br>Keterlambatan<br>(Detik)</th>
                        </tr>
                        <tr>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->format('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->format('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->format('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->format('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->format('l') }}</th>
                        </tr>
                    </thead>

                    <!-- isi tabel -->
                    <tbody>
                        @php $i=1 @endphp
                        @foreach ($data_terlambat as $result)
                            @if($result['monday'] != 0 || $result['tuesday'] != 0 || $result['wednesday'] != 0 || $result['thursday'] != 0 || $result['friday'] != 0)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $result['nama'] }}</td>
                                    <td>{{ $result['unitkerja'] }}</td>
                                    <td>{{ $result['monday'] }}</td>
                                    <td>{{ $result['tuesday'] }}</td>
                                    <td>{{ $result['wednesday'] }}</td>
                                    <td>{{ $result['thursday'] }}</td>
                                    <td>{{ $result['friday'] }}</td>
                                    <td>{{ $result['monday']+$result['tuesday']+$result['wednesday']+$result['thursday']+$result['friday'] }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.getElementById('status').onchange = function() {
        window.location.href = this.children[this.selectedIndex].getAttribute('href');
    }

    function dateFilter(){
        document.getElementById("filterDate").submit()
    }
</script>
