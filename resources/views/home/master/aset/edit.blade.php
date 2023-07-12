@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/aset/{{ $data->id }}" method="post">
        @csrf
        <p class="card-description">Edit Aset </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" maxlength="255"  value="{{ $data->nama }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Merk</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="merk" name="merk" maxlength="255" value="{{ $data->merk }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jumlah</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="jumlah" name="jumlah" maxlength="255"  value="{{ $data->jumlah }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kapasitas</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="kapasitas" name="kapasitas" maxlength="255"  value="{{ $data->kapasitas }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kode Unit</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="kodeUnit" name="kodeUnit" maxlength="255"  value="{{ $data->kodeUnit }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tahun</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tahun" name="tahun" maxlength="255"  value="{{ $data->tahun }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nomer Rangka</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="rangka" name="rangka" maxlength="255"  value="{{ $data->rangka }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nomer Mesin</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="mesin" name="mesin" maxlength="255"  value="{{ $data->mesin }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kebersihan</label>
              <div class="col-sm-9">
                <select class="form-control" aria-label="Default select example" id="kebersihaan" name="kebersihaan" value="{{ $data->kebersihan }}">
                  <option value="{{$data->kebersihan}}">{{$data->kebersihan}}</option>
                  <option value="bersih">Bersih</option>
                  <option value="kotor">Kotor</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Bahan Bakar</label>
              <div class="col-sm-9">
                <select class="form-control" aria-label="Default select example" id="bahanBakar" name="bahanBakar" value="{{ $data->bahanBakar }}">
                  <option value="{{ $data->bahanBakar }}">{{ $data->bahanBakar }}</option>
                  <option value="25%">25%</option>
                  <option value="50%">50%</option>
                  <option value="75%">75%</option>
                  <option value="100%">10%</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <select class="form-control" aria-label="Default select example" id="status" name="status" value="{{ $data->status }}">
                  <option value="tersedia">Tersedia</option>
                  <option value="reserverd">Reserverd</option>
                  <option value="service">Service</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <div class="col-sm-9">
                <input type="checkbox" name="isHide" id="isHide" value="true" @if($data->isHide == 'true') checked @endif>
                <label class="form-label">Sembunyikan dari daftar permohonan?</label>
              </div>
            </div>
          </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
              <a href="/aset" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection