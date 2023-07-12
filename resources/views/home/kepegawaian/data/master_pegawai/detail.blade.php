@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Detail Pegawai</h2>
</div>

<!-- Button ini muncul ketika status pegawai aktif dan kembali ke master pegawai -->
@if($nonpns->is_active != false)
<a href="/master-pegawai" class="btn btn-danger">Kembali</a>
@endif

<!-- Button ini muncul ketika status pegawai tidak aktif dan kembali ke pegawai tidak aktif -->
@if($nonpns->is_active != true)
<a href="/nonaktif" class="btn btn-danger">Kembali</a>
@endif

<div class="col-lg-12 grid-margin stretch-card"><br>
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b style="color:black;">{{$nonpns->fullname}}</b>
        </a>
    </div>
    <div class="nav navbar navbar-expand navbar-light bg-light border-bottom p-0">
      <div class="container justify-content-center justify-content-md-between">
       
        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" style="color:black;" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">DATA PEGAWAI</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:black;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">PERSONAL</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:black;" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">PENDIDIKAN</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:black;" class="tablinks" id="pills-info-tab" data-bs-toggle="pill" data-bs-target="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false">INFO LAIN</a>
          </li>
          <!-- Kondisi untuk pegawai berstatus aktif maka akan memunculkan button edit -->
          @if($nonpns->is_active != false)
          <a href="/nonpns/{{ $nonpns->id }}" class="btn btn-warning">Edit Data</a>
          @endif
      </ul>
      
    </div>
  </div>
    <div class="card-body">
      <div class="tab-content">

        <!-- pegawai -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <p class="card-description">DATA KEPEGAWAIAN</p>
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <label class="col col-form-label" style="font-size:13px;">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="fullname"
                  value="{{$nonpns->fullname}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label class="col col-form-label" style="font-size:13px;">Tanggal Bergabung</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggalBergabung"
                  value="{{$nonpns->join_date}}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <label class="col col-form-label" style="font-size:13px;">Divisi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="divisi"
                  value="{{$nonpns->divisi}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label class="col col-form-label" style="font-size:13px;">Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jabatan"
                  value="{{$nonpns->jabatan}}" readonly>
                </div>
              </div>
            </div>
          </div>
          @if($jabatan != null)
          <label>DESKRIPSI JABATAN</label>
          <div class="row card m-2 p-3">
            <p>{!! $jabatan->description !!}</p>
          </div>
          @endif
        </div>
    <!-- personal -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <p class="card-description">DATA PERSONAL</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tempatLahir"
                  value="{{$nonpns->birth_place}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggalLahir"
                    value="{{$nonpns->birth_date}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="jenisKelamin"
                  value="{{$nonpns->gender}}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Agama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="agama"
                    value="{{$nonpns->religion}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pernikahan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perkawinan"
                    value="{{$nonpns->marital_status}}" readonly>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Kedudukan Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kedudukanPegawai"
                    value="{{$nonpns->kedudukanPegawai}}" readonly>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        
         <!-- pendidikan -->
         <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <p class="card-description">DATA PENDIDIKAN</p>
           <div class="row"> 
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Kategori Pendidikan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAwal"
                    value="{{$nonpns->pendidikanAwal}}" readonly>
                </div>
              </div>
            </div> 
            <!-- <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Awal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAwal"
                    value="{{$nonpns->jurusanPendidikanAwal}}" readonly>
                </div>
              </div>
            </div> -->
          </div> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAkhir"
                    value="@if($nonpns->pendidikan != ''){{$nonpns->pendidikan->educational_level}}@endif" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAkhir"
                    value="@if($nonpns->pendidikan != ''){{$nonpns->pendidikan->majors}}@endif" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Perguruan Tinggi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perguruanTinggi"
                    value="@if($nonpns->pendidikan != ''){{$nonpns->pendidikan->name_educational_institution}}@endif" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tahun Lulus</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tahunLulus"
                    value="@if($nonpns->pendidikan != ''){{$nonpns->pendidikan->graduation_year}}@endif" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Info lain -->
        <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
          <p class="card-description">DATA INFO LAINNYA</p>
          <div class="row">
            <!-- <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nik"
                    value="{{$nonpns->nik}}" readonly>
                </div>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email"
                    value="{{$nonpns->email}}" readonly>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="username"
                  value="{{$nonpns->username}}" readonly/>
                </div>
              </div>
            </div> -->
            
          </div>
          <div class="row">
            <!-- <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Akses</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noAkses"
                    value="{{$nonpns->noAkses}}" readonly>
                </div>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No NPWP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noNpwp"
                    value="{{$nonpns->npwp}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No HP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="hp"
                    value="{{$nonpns->telephone}}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Akses</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noAkses"
                    value="{{$nonpns->noAkses}}" readonly>
                </div>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Alamat</label>
                <div class="col-sm-9">
                  <textarea name="alamatRumah" id="alamatRumah" class="form-control" rows="5" readonly>{{$nonpns->current_address}}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
</div>
@endsection