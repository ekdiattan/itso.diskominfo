@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Data Pegawai</h2>
</div>

<form action="/update-nonpns/{{ $edit->id }}" method="post">
    @csrf
<div class="col-lg-12 grid-margin stretch-card"><br>
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b>{{$edit->fullname}}</b>
        </a>
    </div>

    <div class="card-body">
      <div class="tab-content">

        <!-- pegawai -->
          <p class="card-description">DATA KEPEGAWAIAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="fullname"
                  value="{{$edit->fullname}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Divisi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="divisi"
                  value="{{$edit->divisi}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jabatan"
                  value="{{$edit->jabatan}}">
                </div>
              </div>
            </div> 
          </div>
        
        <!-- personal -->
          <p class="card-description">DATA PERSONAL</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="birth_place"
                  value="{{$edit->birth_place}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="birth_date"
                  value="{{$edit->birth_date}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="gender"
                  value="{{$edit->gender}}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Agama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="religion"
                  value="{{$edit->religion}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pernikahan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="marital_status"
                  value="{{$edit->marital_status}}"/>
                </div>
              </div>
            </div>
          </div>

          <!-- personal -->
          <p class="card-description">DATA PENDIDIKAN</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Terakhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="educational_level"
                  value="@if($edit->pendidikan != ''){{$edit->pendidikan->educational_level}}@endif"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan AKhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="majors"
                  value="@if($edit->pendidikan != ''){{$edit->pendidikan->majors}}@endif">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Perguruan Tinggi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name_educational_institution"
                  value="@if($edit->pendidikan != ''){{$edit->pendidikan->name_educational_institution}}@endif">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tahun Lulus</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="graduation_year"
                  value="@if($edit->pendidikan != ''){{$edit->pendidikan->graduation_year}}@endif"/>
                </div>
              </div>
            </div>
          </div>

          <!-- Info Lain -->
          <p class="card-description">DATA INFO LAINNYA</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email"
                    value="{{$edit->email}}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No NPWP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noNpwp"
                    value="{{$edit->npwp}}">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No HP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="hp"
                    value="{{$edit->telephone}}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Alamat</label>
                <div class="col-sm-9">
                  <textarea name="alamatRumah" id="alamatRumah" class="form-control" rows="5" >{{$edit->current_address}}</textarea>
                </div>
              </div>
            </div>
          </div>
      </div>
      <br><br><a href="/detail-nonpns/{{$edit->id}}" class="btn btn-danger">Kembali</a>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</div>
</form>
@endsection