@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/update-pengecualian/{{ $pengecualian->id }}" method="post">
        @csrf
        <p class="card-description">Edit Nama Keterangan Libur </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">NIP</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $pengecualian->nip }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Pegawai</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengecualian->nama }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Unit Kerja</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="unitkerja" name="unitkerja" value="{{ $pengecualian->unitkerja }}" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Mulai</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="mulai" name="mulai" value="{{ $pengecualian->mulai }}"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Selesai</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="selesai" name="selesai" value="{{ $pengecualian->selesai }}"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Keterangan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $pengecualian->keterangan }}"/>
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