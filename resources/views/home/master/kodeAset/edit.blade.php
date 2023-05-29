@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/kodeAset/{{ $data->id }}" method="post">
        @csrf
        <p class="card-description">Edit Data Maser Aset </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kode Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" value="{{ $data->kodeBarang }}" maxlength="255" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jenis Aset</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="jenisAset" name="jenisAset" value="{{ $data->jenisAset }}" maxlength="255" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Umur Ekonomis</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="umurEkonomis" name="umurEkonomis" value="{{ $data->umurEkonomis }}" maxlength="255" required/>
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
                <a href="/kodeAset" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection