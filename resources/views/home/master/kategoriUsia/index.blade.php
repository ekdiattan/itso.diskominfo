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
          <h4 class="card-title">Tambahkan Keterangan Kategori Usia</h4>
          <form action="/usia/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="exampleInputUsername1">Kategori Usia</label>
              <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="form-group">
              <label for="dari">Dari Usia</label>
              <input type="number" class="form-control" id="dari" name="dari" required>
            </div>
            <div class="form-group">
              <label for="hindda">Hingga Usia</label>
              <input type="number" class="form-control" id="hingga" name="hingga" required>
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
            <h4 class="card-title mb-1">Daftar Keterangan Kategori Usia</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Kategori</th>
                          <th>Dari</th>
                          <th>Hingga</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($usias as $usia )  
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $usia->kategori }}</td>
                          <td>{{ $usia->dari }}</td>
                          <td>{{ $usia->hingga }}</td>
                          <td>
                            <a href="/usia/{{ $usia->id }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/usia/delete/{{ $usia->id }}" method="get" class="d-inline">
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