@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
<div id="dataTable_wrapper" class="dt_bootstrap4">
         <div class="card">
              <div class="card-body">
                  <a class="btn btn-success" role="button" href="/inventaris/create">+ Create New</a>
                  <a class="btn btn-primary" role="button" href="/export-excel">Export Excel</a>

                  <div id="example1_filter" class="dataTables_filter">
                    <form action="/jumlah-cuti" method="GET">
                        <form class="d-flex" role="search">
                            <a href="/jumlah-cuti"  class="btn btn-danger" role="button">Reset</a>
                        </form>
                        <br>
                    </form>
                  </div>
                <table id="dataTable" class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th width="10%" rowspan="2">Nama</th>
                                <th width="10%" rowspan="2">Unit Kerja</th>
                                <th colspan="3">Jumlah Cuti Tahunan yang sudah Diambil</th>
                            </tr>
                                <th width="10%" >{{ $year-2 }}</th>
                                <th width="10%" >{{ $year-1 }}</th>
                                <th width="10%" >{{ $year }}</th>
                        </thead>
                        <tbody>
                            @foreach($cutis as $cuti)
                            @if($cuti['year'] != 0 || $cuti['yearbfr'] != 0 || $cuti['yearbfrbfr'] != 0)
                                <tr>
                                    <td>{{ $cuti['name'] }}</td>
                                    <td>{{ $cuti['unit'] }}</td>
                                    <td>{{ $cuti['yearbfrbfr'] }}</td>
                                    <td>{{ $cuti['yearbfr'] }}</td>
                                    <td>{{ $cuti['year'] }}</td>
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