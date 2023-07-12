@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/unitkerja/{{ $data->id }}" method="post">
        @csrf
        <p class="card-description">Edit Nama Unit Kerja </p>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label class="col col-form-label">Nama Unit Kerja</label>
              <input type="text" class="form-control" id="namaUnit" name="namaUnit" value="{{ $data->namaUnit }}" />
            </div>
            <div class="form-group">
              <label class="col col-form-label">Alias Unit Kerja</label>
              <input type="text" class="form-control" id="aliasUnit" name="aliasUnit" value="{{ $data->aliasUnit }}" />
            </div><div class="form-group">
              <label class="col col-form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}" />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label class="col col-form-label">Divisi</label>
              <input type="text" class="form-control" id="divisi" name="divisi" value="{{ $data->unitKerjaApi }}" disabled/>
            </div>
            <div class="form-group">
              <label class="col col-form-label">Alias Divisi</label>
              <input type="text" class="form-control" id="unitKerjaApiLengkap" name="unitKerjaApiLengkap" value="{{ $data->unitKerjaApiLengkap }}"/>
            </div>
            <!-- <div class="form-group">
              <label class="col col-form-label">Pemimpin Divisi</label>
              <select class="form-control selectpicker" id="namaPemohon" name="namaPemohon" data-live-search="true">
                <option data-tokens="" value=""></option>
              </select>
            </div> -->
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <a href="/unitkerja" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection