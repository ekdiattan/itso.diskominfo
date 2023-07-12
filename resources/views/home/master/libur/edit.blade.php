@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/libur/{{ $libur->id }}" method="post">
        @csrf
        <p class="card-description">Edit Nama Keterangan Libur </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Libur</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="namaLibur" name="namaLibur" value="{{ $libur->nama }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ $libur->tanggal }}" />
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <a href="/libur" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection