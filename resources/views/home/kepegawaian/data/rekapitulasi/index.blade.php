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
                        <select class="form-control input-sm select2" id="status" name="status" onChange="location = this.value">
                            <option selected value="/rekap/terlambat-masuk">Rekapitulasi Terlambat Masuk PNS</option>
                            <option value="/rekap/terlambat-masuk-unit">Rekapitulasi Terlambat Masuk Unit</option>
                            <option value="/rekap/tidak-absen-pulang">Rekapitulasi Tidak Absen Pulang PNS</option>
                        </select>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Masukan Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <form action="/rekap/terlambat-masuk" method="get" id="filterDate">
                                    <input class="form-control" type="date" id="tanggal" name="tanggal" data-select2-id="tanggal" tabindex="-1" aria-hidden="true" onChange="dateFilter()" value="{{ $date != null ? $date : $tgl}}">
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
                            <td colspan="5" style="text-align:center; font-weight:bold;">Periode {{ $tgl->translatedFormat('d M Y') }} hingga {{ $tgl->addDays('4')->translatedFormat('d M Y') }} </td>
                            <th rowspan="2" style="vertical-align:middle">Total Keterlambatan</th>
                        </tr>
                        <tr>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->translatedFormat('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->translatedFormat('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->translatedFormat('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->translatedFormat('l') }}</th>
                            <th style='text-align:center; font-weight:bold;'>{{ $days->addDays('1')->translatedFormat('l') }}</th>
                        </tr>
                    </thead>

                    <!-- isi tabel -->
                    <tbody>
                        @php $i=1 @endphp
                        @foreach ($data_terlambat as $result)
                            @if(($result['monday'] != 0 && $result['monday'] != "Libur") || ($result['tuesday'] != 0 && $result['tuesday'] != "Libur") || ($result['wednesday'] != 0 && $result['wednesday'] != "Libur") || ($result['thursday'] != 0 && $result['thursday'] != "Libur") || ($result['friday'] != 0 && $result['friday'] != "Libur"))
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $result['nama'] }}</td>
                                    <td>{{ $result['unitkerja'] }}</td>
                                    <td class="{{ $result['monday'] != 'Libur' ? '' : 'table-danger' }}">{{ $result['monday'] == 0 ? '' : ($result['monday'] != "Libur" ?  $result['monday'].' detik' : "Libur" )}}</td>
                                    <td class="{{ $result['tuesday'] != 'Libur' ? '' : 'table-danger' }}">{{ $result['tuesday'] == 0 ? '' : ($result['tuesday'] != "Libur" ? $result['tuesday'].' detik' : "Libur")}}</td>
                                    <td class="{{ $result['wednesday'] != 'Libur' ? '' : 'table-danger' }}">{{ $result['wednesday'] == 0 ? '' : ($result['wednesday'] != "Libur" ? $result['wednesday'].' detik' : "Libur")}}</td>
                                    <td class="{{ $result['thursday'] != 'Libur' ? '' : 'table-danger' }}">{{ $result['thursday'] == 0 ? '' : ($result['thursday'] != "Libur" ? $result['thursday'].' detik' : "Libur")}}</td>
                                    <td class="{{ $result['friday'] != 'Libur' ? '' : 'table-danger' }}">{{ $result['friday'] == 0 ? '' : ($result['friday'] != "Libur" ? $result['friday'].' detik' : "Libur")}}</td>
                                    <td>{{ ($result['monday'] == "Libur" ? 0 : $result['monday'])+($result['tuesday'] == "Libur" ? 0 : $result['tuesday'])+($result['wednesday'] == "Libur" ? 0 : $result['wednesday'])+($result['thursday'] == "Libur" ? 0 : $result['thursday'])+($result['friday'] == "Libur" ? 0 : $result['friday']).' detik' }}</td>
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
    function dateFilter(){
        document.getElementById("filterDate").submit()
    }
</script>
