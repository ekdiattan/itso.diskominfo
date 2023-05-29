@extends('home.partials.main')
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
          <h4 class="card-title">Tambahkan Role</h4>
          <form action="/role/create" method="post" >
            @csrf
            <div class="form-group">
              <br>
              <label for="exampleInputUsername1">Nama Role</label>
              <input type="text" class="form-control" id="role" name="role" required>
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
            <h4 class="card-title mb-1">Daftar Role</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Nama Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $key => $post )  
                        <tr>
                          <td>{{ $roles->firstItem() + $key }}</td>
                          <td>{{ $post->role }}</td>
                          <td>
                            <a href="{{ url('/role/'.$post->id) }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/role/delete/{{$post->id}}" method="get" class="d-inline">
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"  ><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
                            </form>
                          </td>
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