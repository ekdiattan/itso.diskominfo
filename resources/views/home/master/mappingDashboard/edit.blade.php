@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/mappingDashboard-upd/{{ $edit->id }}" method="post">
        @csrf
        <p class="card-description">Edit Mapping Dashboard</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Widget</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="NameCard" name="NameCard"  value="{{ $edit->NameCard }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Warna Widget</label>
              <div class="col-sm-2">
                <input type="color" class="form-control" id="Warna" name="Warna" value="{{ $edit->Warna }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Warna Widget</label>
              <div class="col-sm-5">
                <select class="form-control" aria-label="Default select example" id="Route" name="Route" value="{{ $edit->Route }}" required>
                  <option value="">{{ $edit->Route }}</option>
                  <option value="/laporan">Catatan IT</option>
                  <option value="/booking">Aset - Peminjaman</option>
                  <option value="/inventaris">Aset - Inventaris</option>
                  <option value="/keamanan">Keamanan - Peminjaman</option>
                  <option value="/master-pegawai">Kepegawaian</option>
              </select>
              </div>
            </div>
          </div>
        </div>
        
          <div class="box">
            <div class="box-header with-border">
              <a href="/mapDashboard" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection