@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-4 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambahkan Keterangan Libur</h4>
          <form action="/libur/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="exampleInputUsername1">Keterangan Libur</label>
              <input type="text" class="form-control" id="namaLibur" name="namaLibur" required>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row justify-content-between">
            <h4 class="card-title mb-1">Daftar Keterangan Liburan</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Nama Liburan</th>
                          <th>Tanggal</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($liburs as $key=> $post )  
                        <tr>
                          <td>{{ $liburs->firstItem() + $key }}</td>
                          <td>{{ $post->nama }}</td>
                          <td>{{ $post->tanggal }}</td>
                          <td>
                            <a href="/libur/{{ $post->id }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/libur/delete/{{ $post->id }}" method="get" class="d-inline">
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
                            </form>
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
    </div>
  </div>
  
@endsection