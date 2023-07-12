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
          <h4 for="exampleInputUsername1">Tambahkan Kategori Pendidikan</h4>
          <form action="/katpen/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="exampleInputUsername1" class="">Kategori Pendidikan</label>
              <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Jurusan</label>
              <select class="form-control selectpicker" aria-label="Default select example"  data-live-search="true" id="jurusan" name="jurusan" required>
                  <option value="">--PILIH--</option>
                  @foreach($data as $data)
                  <option value="{{$data->majors}}">{{$data->majors}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan">
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
            <h4 class="card-title mb-1">Daftar Kategori Pendidikan</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Kategori Pendidikan</th>
                          <th>Jurusan</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($katpen as $post )  
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $post->kategori }}</td>
                          <td>{{ $post->jurusan }}</td>
                          <td>{{ $post->keterangan }}</td>
                          <td>
                            <a href="/katpen/edit/{{$post->id}}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/katpen/delete/{{$post->id}}" method="get" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"  ><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
                            </form>
                            @endforeach
                          </td>
                        </tr>

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