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
          <h4 class="card-title">Tambahkan Unit Kerja</h4>
          <form action="/unitkerja/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="namaUnit">Nama Unit Kerja</label>
              <input type="text" class="form-control" id="namaUnit" name="namaUnit" maxlength="255" required>
              <label for="unitKerjaApiLengkap">Alias Unit Kerja</label>
              <input type="text" class="form-control" id="unitKerjaApiLengkap" name="unitKerjaApiLengkap" maxlength="255" required>
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
            <h4 class="card-title mb-1">Daftar Unit Kerja</h4>
            <p class="text-muted mb-1">Sudah ditambahkan</p>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Divisi</th>
                          <th>Unit Kerja</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($unitkerjas as $key => $post )  
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $post->unitKerjaApi }}</td>
                          <td>{{ $post->namaUnit }}</td>
                          <td>
                            <a href="/unitkerja/{{ $post->id }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/unitkerja/delete/{{ $post->id }}" method="get" class="d-inline">
                            @csrf
                            <button class="badge bg-danger border-0"onclick="return confirm('Are you sure?')"><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
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