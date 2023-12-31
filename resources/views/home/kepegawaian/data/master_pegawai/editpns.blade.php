@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Edit Data Pegawai</h3>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b>{{$edit->nama}}</b>
        </a>
    </div>
<form action="/update-pns/{{ $edit->id }}" method="post">
    @csrf
    <div class="card-body">
      <div class="tab-content">

        <!-- pegawai -->
          <p class="card-description">DATA KEPEGAWAIAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nip</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="nip"
                  value="{{$edit->noPegawai}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama"
                    value="{{$edit->nama}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Unit Kerja</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="unitKerja"
                  value="{{$edit->unitKerja}}"/>
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
                    value="{{$edit->golonganPangkat}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Golongan</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="disabledTextinput" name="tmtGolongan"
                  value="{{$edit->tmtGolongan}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Eselon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="eselon"
                    value="{{$edit->eselon}}">
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
                  value="{{$edit->namaJabatan}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Jabatan</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="tmtJabatan"
                    value="{{$edit->tmtJabatan}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pegawai</label>
                <div class="col-sm-9">
                  <!-- <input type="text" class="form-control" id="disabledTextinput" name="statusPegawai"
                  value="{{$edit->statusPegawai}}"/> -->
                  <select name="statusPegawai" class="form-control"{{$edit->statusPegawai}}">
                    <option value="{{$edit->statusPegawai}}">{{$edit->statusPegawai}}</option>
                    <option>--PILIH--</option>
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">TMT Pegawai</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="tmtPegawai"
                    value="{{$edit->tmtPegawai}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Masa Kerja Tahun</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="masaKerjaTahun"
                  value="{{$edit->masaKerjaTahun}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Masa Kerja Bulan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="masaKerjaBulan"
                    value="{{$edit->masaKerjaBulan}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Masuk</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="tanggalmasuk"
                    value="{{$edit->tanggalmasuk}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Keluar</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="tanggalkeluar"
                    value="{{$edit->tanggalkeluar}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Perihal Keluar</label>
                <div class="col-sm-9">
                  <!-- <input type="text" class="form-control" id="disabledTextinput" name="statusPegawai"
                  value="{{$edit->statusPegawai}}"/> -->
                  <select name="reasonPisah" class="form-control"{{$edit->reasonPisah}}">
                    <option value="{{$edit->reasonPisah}}">{{$edit->reasonPisah}}</option>
                    <option>--PILIH--</option>
                    <option>Pindah Tugas</option>
                    <option>Pensiun</option>
                    <option>Wafat</option>
                  </select>
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
                  <input type="text" class="form-control" id="disabledTextinput" name="tempatLahir"
                  value="{{$edit->tempatLahir}}"/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggalLahir"
                    value="{{$edit->tanggalLahir}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jenis Kelamin</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="jenisKelamin"
                  value="{{$edit->jenisKelamin}}"/>
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
                    value="{{$edit->agama}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Status Pernikahan</label>
                <div class="col-sm-9">
                  <select class="form-control selectpicker " aria-label="Default select example" id="perkawinan" name="perkawinan" required>
                    <option value="{{$edit->perkawinan}}">{{$edit->perkawinan}}</option>
                    <option value="">--PILIH--</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Cerai">Cerai</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Kedudukan Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kedudukanPegawai"
                    value="{{$edit->kedudukanPegawai}}">
                </div>
              </div>
            </div>
          </div>
    
        <!-- pendidikan -->
          <p class="card-description">DATA PENDIDIKAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Awal</label>
                <div class="col-sm-9">
                  <select class="form-control selectpicker " aria-label="Default select example" id="pendidikanAwal" name="pendidikanAwal" required>
                    <option value="{{$edit->pendidikanAwal}}">{{$edit->pendidikanAwal}}</option>
                    <option value="">--PILIH--</option>
                    <option value="SMA/SMK/MA/Sederajat">SMA/SMK/MA/Sederajat</option>
                    <option value="D3">Diploma 3</option>
                    <option value="D4">Diploma 4</option>
                    <option value="S1">Sarjana</option>
                    <option value="Magister">Magister</option>
                    <option value="Doktor">Doktor</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Awal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAwal"
                    value="{{$edit->jurusanPendidikanAwal}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Pendidikan Akhir</label>
                <div class="col-sm-9">
                <select class="form-control selectpicker " aria-label="Default select example" id="pendidikanAkhir" name="pendidikanAkhir" required>
                    <option value="{{$edit->pendidikanAkhir}}">{{$edit->pendidikanAwal}}</option>
                    <option value="">--PILIH--</option>
                    <option value="SMA/SMK/MA/Sederajat">SMA/SMK/MA/Sederajat</option>
                    <option value="D3">Diploma 3</option>
                    <option value="D4">Diploma 4</option>
                    <option value="S1">Sarjana</option>
                    <option value="Magister">Magister</option>
                    <option value="Doktor">Doktor</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Jurusan Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAkhir"
                    value="{{$edit->jurusanPendidikanAkhir}}">
                </div>
              </div>
            </div>
          </div>

        <!-- Info lain -->
          <p class="card-description">DATA INFO LAINNYA</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email"
                    value="{{$edit->email}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Akses</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noAkses"
                    value="{{$edit->noAkses}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No NPWP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noNpwp"
                    value="{{$edit->noNpwp}}">
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
                    value="{{$edit->nik}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="alamatRumah"
                    value="{{$edit->alamatRumah}}">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No HP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="hp"
                    value="{{$edit->hp}}">
                </div>
              </div>
            </div>
          </div>
      
      </div>
      
      <br><br><a href="/detail-pegawai/{{$edit->id}}" class="btn btn-danger">Kembali</a>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
</div>
@endsection