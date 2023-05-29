<title>Diskominfo Jabar | Inventaris</title>
@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Tim Inventaris</h2>
  </div>
  
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div id="example1_wrapper" class="dataTables_wrapper dt_bootstrap4">
          <div class="card">
            <div class="card-body">
                <a class="btn btn-success" role="button" href="/inventaris/create">+ Create New</a>
                <a class="btn btn-primary" role="button" href="/export-excel">Export Excel</a>
                <div class="table-responsive">
                 <nav class="navbar bg-body-tertiary">
                    <form action="/inventaris" method="GET">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $search }}">
                        </form>
                    <a href="/inventaris" class="btn btn-danger" role="button">Reset</a>
                    </form>
                 </nav>
                    <table id="example1" class="table table-hover table-bordered table-striped">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Kondisi Barang</th>
                                <th>No Sertifikat</th>
                                <th>Lokasi</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->namaBarang }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->tipe }}</td>
                                    <td>{{ $item->kondisiBarang }}</td>
                                    <td>{{ $item->noSertifikat }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    
                                    <td>
                                        <a href="/inventaris/{{ $item->id }}" class="badge bg-info"><span
                                                class="menu-icon"><i class="far fa-eye"></i></span></a>
                                        <a href="{{ url('inventaris-update/'.$item->id) }}" class="badge bg-warning"><span
                                                class="menu-icon"><i class="far fa-edit"></i></span></a>
                                        <form action="/inventaris/delete/{{ $item->id }}" method="get" class="d-inline">
                                            @csrf
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure?')"><span class="menu-icon"><i
                                                        class="fas fa-trash"></i></span></button>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data->links() }}
          
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
</div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection
    