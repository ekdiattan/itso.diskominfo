@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<form action="/keamanan-prs/{{ $edit->id }}" method="post" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" id="disabledTextinput" name="tiket" id="tiket"
                  value="{{$edit->tiket}}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama Pemohon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="namaPemohon" id="namaPemohon"
                    value="{{$edit->namaPemohon}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">No Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="noTelp" id="noTelp"
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
                  <input type="text" class="form-control" name="bidang" id="bidang"
                    value="{{$edit->bidang}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Mulai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="mulai" id="mulai"
                  value="{{$edit->mulai}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Selesai</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="selesai" id="selesai"
                    value="{{$edit->selesai}}"readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Nama Kendaraan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namaKendaraan" name="namaKendaraan"
                  value="{{$aset->merk}} {{$aset->nama}}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" style="font-size:13px;">Perihal</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="perihal" id="perihal"
                    value="{{$edit->perihal}}" readonly/>
                </div>
              </div>
            </div>
          </div>

        <!-- kondisi kendaraan -->
          <p class="card-description">KONDISI KENDARAAN</p>
          <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Kebersihan</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="kebersihan" name="kebersihan" value="{{$edit->kebersihan}}" readonly required/> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Bahan Bakar</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="bahanBakar" name="bahanBakar" value="{{$edit->bahanBakar}}" readonly required/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Kondisi Kendaraan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$edit->keterangan}}" readonly required/>
                    </div>
                </div>
            </div>
          </div>
        
          <!-- Status -->
          <p class="card-description">STATUS PEMINJAMAN</p>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Status</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  name="status" value="Dipinjam" readonly/ id="status">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:13px;">Pengambil Kunci</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" list="pegawai" id="pengambilKunci" name="pengambilKunci" required>
                        <datalist id="pegawai">
                            @foreach($pegawais as $pegawai)
                            <option value="{{ $pegawai->nama }}">
                            @endforeach
                            @foreach($dtpegawais as $dtpegawai)
                            <option value="{{ $dtpegawai->fullname }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
      <br><br><a href="/keamanan/{{$edit->id}}" class="btn btn-danger">Kembali</a>
      <button type="submit" class="btn btn-primary" id="submit-btn">Proses</button>
    </div>
</form>
</div>
<script>
    const kebersihan = document.getElementById('kebersihan');
    const bahanBakar = document.getElementById('bahanBakar');
    const keterangan = document.getElementById('keterangan');
    const pengambilKunci = document.getElementById('pengambilKunci');
    const submitBtn = document.getElementById('submit-btn');

    kebersihan.addEventListener('input', validateForm);
    bahanBakar.addEventListener('input', validateForm);
    keterangan.addEventListener('input', validateForm);
    pengambilKunci.addEventListener('input', validateForm);

    document.getElementById("submit-btn").disabled = true;

    function validateForm() {
      if (kebersihan.value.trim() === '' || bahanBakar.value.trim() === ''|| keterangan.value.trim() ===''|| pengambilKunci.value.trim() ==='') {
        submitBtn.disabled = true;
      } else {
        submitBtn.removeAttribute('disabled');
      }
    }
  </script>
@endsection