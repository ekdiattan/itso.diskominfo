@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-title">
        <a class="nav-link" class="btn shadow-0 p-0 me-auto">
            <b>{{$pegawai->nama}}</b>
          </a>
    </div>
    <div class="nav navbar navbar-expand navbar-light bg-light border-bottom p-0">
      <div class="container justify-content-center justify-content-md-between">
       
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <button class="nav-link active" style="color:green;" class="tablinks" onclick="openTab(event, 'Tab1')">DATA PEGAWAI</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" style="color:grey;" class="tablinks" onclick="openTab(event, 'Tab2')">PERSONAL</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" style="color:grey;" class="tablinks" onclick="openTab(event, 'Tab3')">PENDIDIKAN</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" style="color:grey;" class="tablinks" onclick="openTab(event, 'Tab4')">INFO LAIN</button>
          </li>
      </ul>
      
    </div>
  </div>
    <div class="card-body">
      <div class="tab-content">

        <!-- pegawai -->
        <div id="Tab1">
          <p class="card-description">DATA KEPEGAWAIAN</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nip</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="nip"
                  value="{{$pegawai->noPegawai}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama"
                    value="{{$pegawai->nama}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Unit Kerja</label>
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
                <label class="col-sm-3 col-form-label">Golongan Pangkat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="golonganPangkat"
                    value="{{$pegawai->golonganPangkat}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">TMT Golongan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tmtGolongan"
                  value="{{$pegawai->tmtGolongan}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Eselon</label>
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
                <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="namaJabatan"
                  value="{{$pegawai->namaJabatan}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">TMT Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tmtJabatan"
                    value="{{$pegawai->tmtJabatan}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status Pegawai</label>
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
                <label class="col-sm-3 col-form-label">TMT Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tmtPegawai"
                    value="{{$pegawai->tmtPegawai}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Masa Kerja Tahun</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="masaKerjaTahun"
                  value="{{$pegawai->masaKerjaTahun}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Masa Kerja Bulan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="masaKerjaBulan"
                    value="{{$pegawai->masaKerjaBulan}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- personal -->
        <div id="Tab2">
          <p class="card-description">DATA PERSONAL</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tempatLahir"
                  value="{{$pegawai->tempatLahir}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="tanggalLahir"
                    value="{{$pegawai->tanggalLahir}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
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
                <label class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="agama"
                    value="{{$pegawai->agama}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status Pernikahan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perkawinan"
                    value="{{$pegawai->perkawinan}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kedudukan Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kedudukanPegawai"
                    value="{{$pegawai->kedudukanPegawai}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <!-- pendidikan -->
        <div id="Tab3">
          <p class="card-description">DATA PENDIDIKAN</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pendidikan Awal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAwal"
                    value="{{$pegawai->pendidikanAwal}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jurusan Pendidikan Awal</label>
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
                <label class="col-sm-3 col-form-label">Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pendidikanAkhir"
                    value="{{$pegawai->pendidikanAkhir}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jurusan Pendidikan Akhir</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="jurusanPendidikanAkhir"
                    value="{{$pegawai->jurusanPendidikanAkhir}}" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Info lain -->
        <div id="Tab4">
          <p class="card-description">DATA INFO LAINNYA</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email"
                    value="{{$pegawai->email}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">No Akses</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="noAkses"
                    value="{{$pegawai->noAkses}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">No NPWP</label>
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
                <label class="col-sm-3 col-form-label">Nik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nik"
                    value="{{$pegawai->nik}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="alamatRumah"
                    value="{{$pegawai->alamatRumah}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">No HP</label>
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
<script>
  function openTab(event, Tab1) {
    // Hide all tab contents
    var tabcontents = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontents.length; i++) {
      tabcontents[i].style.display = "none";
    }
    // Remove 'active' class from all tab buttons
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Show the selected tab content
    document.getElementById(Tab1).style.display = "block";
    
    // Add 'active' class to the clicked tab button
    event.currentTarget.className += " active";
  }
  
  // Show the first tab by default
  document.getElementById("Tab1").style.display = "block";
</script>