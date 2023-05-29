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
          <h4 class="card-title">Tambahkan Satuan</h4>
          <form action="/satuan/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="exampleInputUsername1">Satuan</label>
              <input type="text" class="form-control" id="satuan" name="satuan" required>
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
            <h4 class="card-title mb-1">Daftar Satuan</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Satuan</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($satuans as $key => $post ) 
                        <tr>
                          <td>{{ $satuans->firstItem() + $key }}</td>
                          <td>{{ $post->satuan }}</td>
                          <td>
                            <a href="{{ url('satuan/'.$post->id) }}" class="badge bg-warning"><span
                                class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/satuan/delete/{{$post->id}}" method="get" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0"onclick="return confirm('Are you sure?')"><span class="menu-icon"><i
                                class="fas fa-trash"></i></span></button>
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