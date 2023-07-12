@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/usia/{{ $kategori->id }}" method="post">
        @csrf
        <p class="card-description">Edit Nama Keterangan Libur </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kategori</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $kategori->kategori }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Dari Usia</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="dari" name="dari" value="{{ $kategori->dari }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hingga Usia</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="hingga" name="hingga" value="{{ $kategori->hingga }}" />
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <a href="/usia" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection