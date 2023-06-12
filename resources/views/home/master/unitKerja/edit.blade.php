@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/unitkerja/{{ $data->id }}" method="post">
        @csrf
        <p class="card-description">Edit Nama Unit Kerja </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Unit Kerja</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="namaUnit" name="namaUnit" value="{{ $data->namaUnit }}" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Alias Unit Kerja</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="alias" name="alias" value="{{ $data->alias }}" />
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
                <a href="/unitkerja" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection