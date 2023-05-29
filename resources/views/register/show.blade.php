@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <p class="card-description">Detail Pengguna</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nip</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nip" name="nip"
                  value="{{ $user->nip }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  id="username" name="username"
                   value="{{ $user->username }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $user->jabatan }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="{{ $user->nama_bidang }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Hp</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6" id="emaill" style="display:none">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Hak Akses</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="hak_akses" name="hak_akses" value="{{ $user->hak_akses }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="box-header with-border">
                <a href="{{url('/index/') }}" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
            </div>
        </div>
      </div>
    </div>
</div>

<script src="../../assets/js/hide.js"></script>

@endsection