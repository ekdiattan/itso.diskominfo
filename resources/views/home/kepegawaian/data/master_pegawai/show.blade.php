@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Detail Pegawai</h3>
</div>
<a href="/master-pegawai" class="btn btn-danger">Kembali</a>

<div class="col-lg-12 grid-margin stretch-card"><br>
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b>{{$pegawai->nama}}</b>
        </a>
    </div>
    <div class="nav navbar navbar-expand navbar-light bg-light border-bottom p-0">
      <div class="container justify-content-center justify-content-md-between">
       
        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" style="color:green;" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">DATA PEGAWAI</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:green;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">PERSONAL</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:green;" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">PENDIDIKAN</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" style="color:green;" class="tablinks" id="pills-info-tab" data-bs-toggle="pill" data-bs-target="#pills-info" role="tab" aria-controls="pills-info" aria-selected="false">INFO LAIN</a>
          </li>
          <a href="/pegawai/{{ $pegawai->id }}" class="btn btn-warning">Edit Data</a>
      </ul>
      
    </div>
  </div>
    <div class="card-body">
      <div class="tab-content">

        <!-- pegawai -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <p class="card-description">DATA KEPEGAWAIAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nip</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="nip"
                  value="{{$pegawai->noPegawai}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama"
                    value="{{$pegawai->nama}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Unit Kerja</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="unitKerja"
                  value="{{$pegawai->unitKerja}}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Golongan Pangkat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="golonganPangkat"
                    value="{{$pegawai->golonganPangkat}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Golongan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tmtGolongan"
                  value="{{$pegawai->tmtGolongan}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Eselon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="eselon"
                    value="{{$pegawai->eselon}}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="namaJabatan"
                  value="{{$pegawai->namaJabatan}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tmtJabatan"
                    value="{{$pegawai->tmtJabatan}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="statusPegawai"
                  value="{{$pegawai->statusPegawai}}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tmtPegawai"
                    value="{{$pegawai->tmtPegawai}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Masa Kerja Tahun</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="masaKerjaTahun"
                  value="{{$pegawai->masaKerjaTahun}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Masa Kerja Bulan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="masaKerjaBulan"
                    value="{{$pegawai->masaKerjaBulan}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Gabung</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="masaKerjaBulan"
                    value="{{$pegawai->tanggalmasuk}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Pisah</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="masaKerjaBulan"
                    value="{{$pegawai->tanggalkeluar}}" readonly>
                </div>
              </div>
            </div>
          </div>
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
                  value="{{$pegawai->tempatLahir}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggalLahir"
                    value="{{$pegawai->tanggalLahir}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="jenisKelamin"
                  value="{{$pegawai->jenisKelamin}}" readonly/>
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
                    value="{{$pegawai->agama}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pernikahan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perkawinan"
                    value="{{$pegawai->perkawinan}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Kedudukan Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kedudukanPegawai"
                    value="{{$pegawai->kedudukanPegawai}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <!-- pendidikan -->
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <p class="card-description">DATA PENDIDIKAN</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Awal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAwal"
                    value="{{$pegawai->pendidikanAwal}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Awal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAwal"
                    value="{{$pegawai->jurusanPendidikanAwal}}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAkhir"
                    value="{{$pegawai->pendidikanAkhir}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAkhir"
                    value="{{$pegawai->jurusanPendidikanAkhir}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Info lain -->
        <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
          <p class="card-description">DATA INFO LAINNYA</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email"
                    value="{{$pegawai->email}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Akses</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noAkses"
                    value="{{$pegawai->noAkses}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No NPWP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noNpwp"
                    value="{{$pegawai->noNpwp}}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nik"
                    value="{{$pegawai->nik}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="alamatRumah"
                    value="{{$pegawai->alamatRumah}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No HP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="hp"
                    value="{{$pegawai->hp}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>
</div>
@endsection