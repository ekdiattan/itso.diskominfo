@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Merk</h4>
      <form action="/merk/{{ $edit->id }}" method="post">
        @csrf
        <p class="card-description">Edit Merk </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Merk</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="merk" name="merk" value="{{ $edit->merk }}" />
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
                <a href="{{url('/merk') }}" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
                  <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection