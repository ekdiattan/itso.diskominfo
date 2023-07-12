@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Terlambat Masuk, {{ date('d-M-Y') }}
                </h4>
                <div class="table-sm table-responsive">
                    <table id="dataTable" class="table table-bordered dataTable table-contextual" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Unit Kerja</td>
                                <th>Total (Detik)</td>
                                <th>Total (Menit)</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($belum_absendet as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->unitkerja }}</td>
                                    <td>{{ number_format($item->terlambat) }}</td>

                                    @php $minute= $item->terlambat @endphp

                                    <td>{{ number_format($minute / 60, 2, ',', 0) }}</td>
                                </tr>
                            @endforeach
                            <tfoot class="table-info">
                                <td colspan="3">Total Keterlambatan</td>
                                <td>@if($sum_sec != 0)
                                    {{ number_format($sum_sec) }}
                                    @else
                                    {{ 'Tidak ada keterlambatan' }}
                                    @endif
                                </td>
                                <td>@if($sum_sec != 0)
                                    {{ number_format($sum_sec / 60, 2, ',', 0) }}
                                    @else
                                    {{ 'Tidak ada keterlambatan' }}
                                    @endif
                                </td>
                            </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
