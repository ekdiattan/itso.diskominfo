@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<form action="/booking-prsbarang/{{ $edit->id }}" method="post" enctype="multipart/form-data">
@csrf
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b>{{$edit->nama}}</b>
        </a>
    </div>

    <div class="card-body">
      <div class="tab-content">

        <!-- Data Peminjaman -->
          <p class="card-description">DATA PEMINJAMAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tiket"
                  value="{{$edit->tiket}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama Pemohon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="namaPemohon"
                    value="{{$edit->namaPemohon}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="noTelp"
                  value="{{$edit->noTelp}}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Bidang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="bidang"
                    value="{{$edit->bidang}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Mulai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="mulai"
                  value="{{$edit->mulai}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Selesai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="selesai"
                    value="{{$edit->selesai}}"readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama Aset</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="namaKendaraan"
                  value="{{$aset->merk}} {{$aset->nama}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Perihal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perihal"
                    value="{{$edit->perihal}}" readonly/>
                </div>
              </div>
            </div>
          </div>

        <!-- kondisi Aset -->
          <p class="card-description">KONDISI ASET</p>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="status" name="status" required>
                        <option value="">--Pilih Aset--</option>
                        <option value="Selesai">Selesai</option>
                      </select>
                    </div>
                </div>
            </div>
          </div>
      <br><br><a href="/booking-acc" class="btn btn-danger">Kembali</a>
      <button type="submit" class="btn btn-primary">Proses</button>
    </div>
</form>
</div>
@endsection