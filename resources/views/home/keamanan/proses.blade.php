@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<form action="/keamanan-prs/{{ $edit->id }}" method="post" enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body"> 
            <div class="form-group">
                <label for="exampleInputUsername1">Status</label>
                <select class="form-control" aria-label="Default select example" id="status" name="status" required>
                <option value="">--PILIH--</option>
                <option value="Dipinjam">Dipinjam</option>
                <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Pengambil Kunci</label>
                <input type="text" class="form-control" id="pengambilKunci" name="pengambilKunci">
            </div>
        </div>
    </div> 
</div>

<div class="col-md-6 grid-margin stretch-card text-center">
    <div class="card">
        <div class="card-body">
            <a href="/keamanan/{{$edit->id}}" style="width:200px;" class="btn btn-danger">Kembali</a>
            <input type="submit" style="width:200px;" class="btn btn-primary">
        </div>
    </div>
</div>
</form>
@endsection