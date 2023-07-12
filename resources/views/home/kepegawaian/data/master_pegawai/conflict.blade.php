@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2>Tinjau Data Pegawai PNS</h2>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-hover table-bordered table-striped table-responsive-lg">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th width="5%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @php $i=1 @endphp -->
                            @foreach ($conflicts as $item)
                            <tr onClick="window.location='/pegawai-resolve/{{ $item->noPegawai }}'">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $item->noPegawai }}</td>
                                <td class="text-left">{{ $item->nama }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2>Tinjau Data Pegawai non PNS</h2>
                </div>
                <div class="card-body">
                    <table id="dataTable2" class="table table-hover table-bordered table-striped table-responsive-lg">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th width="5%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dtConflicts as $item)
                            <tr onClick="window.location='/pegawai-resolve/{{ $item->user_id }}'">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $item->nip }}</td>
                                <td class="text-left">{{ $item->fullname }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection