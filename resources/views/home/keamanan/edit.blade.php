@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<form action="/keamanan-upd/{{ $edit->id }}" method="post" enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body"> 
            <div class="form-group">
                <label for="exampleInputUsername1">Kebersihan</label>
                <select class="form-control" aria-label="Default select example" id="kebersihan" name="kebersihan" required>
                <option value="">--PILIH--</option>
                <option value="bersih">Bersih</option>
                <option value="kotor">Kotor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1" >Bahan Bakar</label>
                <select class="form-control" aria-label="Default select example" id="bahanBakar" name="bahanBakar" required>
                <option value="">--PILIH--</option>
                <option value="25%">25%</option>
                <option value="50%">50%</option>
                <option value="75%">75%</option>
                <option value="100%">100%</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Kondisi Kendaraan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
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