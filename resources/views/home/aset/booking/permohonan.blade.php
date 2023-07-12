<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@extends('home.partials.public')
<div class="preloader flex-column justify-content-center align-items-center">
<div class="spinner-border text-primary" role="status">
  <span class="visually-hidden"></span>
</div>
  </div>
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>

@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<br><br>
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form id="formPermohonan" action="/permohonan-store" method="post" enctype="multipart/form-data">
          @csrf
          <h4 class="card-description">Permohonan Peminjaman Aset</h4><br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pemohon</label>
                <div class="col-sm-9">
                  <select class="form-control selectpicker" id="namaPemohon" name="namaPemohon" data-live-search="true" onchange="setBidang();">
                    @foreach($pegawais as $pegawai)
                      <option data-tokens="{{ $pegawai->nama }}" value="{{ $pegawai->nama }}" @if($before != null){{ $before['namaPemohon'] == $pegawai->nama ? 'selected' : '' }}@endif>{{ $pegawai->nama }}</option>
                    @endforeach
                  </select>
                  <!-- <input type="text" class="form-control" id="namaPemohon" name="namaPemohon" list="pegawai" autocomplete="off" onchange="setBidang();" onfocus="setBidang(); showOtherForm();" value="@if($before != null){{ $before['namaPemohon'] }}@endif" required autofocus/>
                  <datalist id="pegawai">
                    @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->nama }}">
                    @endforeach
                  </datalist> -->
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                  <select class="form-control" id="unitkerja" name="unitkerja" onfocus="setBidang()">
                    @foreach ($unitkerja as $unitkerja)
                      <option value="{{ $unitkerja->namaUnit }}">{{ $unitkerja->namaUnit }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!--<div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nip" name="nip" value="@if($before != null){{ $before['nip'] }}@endif" required/>
                </div>
              </div>
            </div>-->
            <input type="hidden" class="form-control" id="nip" name="nip" value="@if($before != null){{ $before['nip'] }}@endif" required/>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomer Wa</label>
                <div class="col-sm-9 input-group">
                  <span class="input-group-text" id="basic-addon3">+62</span>
                  <input type="number" class="form-control" id="noTelp" name="noTelp" aria-describedby="basic-addon3 basic-addon4" value="@if($before != null){{ $before['noTelp'] }}@endif" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="nama_email" name="nama_email" value="@if($before != null){{ $before['nama_email'] }}@endif" required/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="jenisAset">Jenis Aset</label>
                <div class="col-sm-9">
                  <input type="radio" name="jenisAset" id="ruangan" value="Ruangan" onClick="check(); showPeriodForm();" @if($before != null){{ $before['jenisAset'] == 'Ruangan' ? 'checked' : '' }}@endif>
                  Ruangan
                  <input type="radio" name="jenisAset" id="kendaraan" value="Kendaraan" onClick="check(); showPeriodForm();" @if($before != null){{ $before['jenisAset'] == 'Kendaraan' ? 'checked' : '' }}@endif>
                  Kendaraan
                  <input type="radio" name="jenisAset" id="barang" value="Barang" onClick="check(); showPeriodForm();" @if($before != null){{ $before['jenisAset'] == 'Barang' ? 'checked' : '' }}@endif>
                  Barang Lainnya
                </div>
              </div>
            </div>
          </div>
          <div id="period" hidden>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mulai Pinjam</label>
                  <div class="col-sm-9">
                    <input type="datetime-local" placeholder="dd-mm-yyyy" class="form-control" id="mulai" name="mulai" onChange="check()" value="@if($before != null){{ $before['mulai'] }}@endif" required/>
                    <br>
                    <div class="alert alert-danger" id="alertConflict" hidden>Aset masih sedang dipinjam pada jangka waktu ini</div>
                    <div class="alert alert-warning" id="alertWrongInput" hidden>Periksa kembali Waktu mulai dan selesai Anda</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Selesai Pinjam</label>
                  <div class="col-sm-9">
                    <input type="datetime-local" class="form-control" id="selesai" name="selesai" onChange="check()" value="@if($before != null){{ $before['selesai'] }}@endif" required/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="otherForm" hidden>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama Aset</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="aset" name="aset" required>
                      <option value="">--Pilih Aset--</option>
                      @foreach ($aset as $aset)
                      <option value="{{ $aset->id }}">{{ $aset->merk }} {{ $aset->nama }} ({{ $aset->kodeUnit }})</option>
                      @endforeach
                    </select>
                    <div class="alert alert-warning" role="alert">
                      Hanya yang dapat dipinjam pada periode waktu mulai dan selesai.
                    </div>
                    <a role="button" id="btnJadwal" hidden>Jadwal Peminjaman</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="keperluan">Keperluan</label>
                  <div class="col-sm-9">
                    <input type="radio" name="keperluan" id="dinas" value="Dinas" checked>
                    Dinas
                    <input type="radio" name="keperluan" id="pribadi" value="Pribadi">
                    Pribadi
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Perihal</label>
                  <div class="col-sm-9">
                    <textarea id="textbox" class="form-control" maxlength="255" name="perihal" rows="5" required></textarea>
                    <span id="char_count"></span>
                  </div>
                </div>
              </div>
            </div>
            <a class="btn btn-danger" href="/pinjam/" role="button">Kembali</a>
            <button type="submit" class="btn btn-primary mr-2" id="btnSubmit" onclick="hideButton()">Submit</button> 
            <button class="btn btn-primary" type="button" id="btn2" style="display:none;">
              <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
              <span class="spinner-grow spinner-grow-sm text-warning" role="status" aria-hidden="true"></span>
              <span class="spinner-grow spinner-grow-sm text-success" role="status" aria-hidden="true"></span>
              <!-- <span class="visually-hidden">Loading...</span> -->
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
<script>

window.onload = function() {
  setBidang();
  showOtherForm();
  showPeriodForm();
};
  
  let textArea = document.getElementById("textbox");
  let characterCounter = document.getElementById("char_count");
  const maxNumOfChars = 255;

  const countCharacters = () => {
      let numOfEnteredChars = textArea.value.length;
      let counter = maxNumOfChars - numOfEnteredChars;
      characterCounter.textContent = counter + "/255 Karakter";
      if (counter <= 0) {
      characterCounter.textContent = "Tidak bisa lebih dari 255 karakter";
      characterCounter.style.color = "red";
      } else if (counter < 75) {
      characterCounter.style.color = "red";
      } else if (counter < 150) {
      characterCounter.style.color = "orange";
      }else {
      characterCounter.style.color = "black";
      }
  };
  textArea.addEventListener("input", countCharacters);

  // Set form bidang ketika nama pemohon diinput
  function setBidang(){
    const name = document.getElementById('namaPemohon').value;
    let pegawais = @json($pegawais);
    for(let i = 0; i < pegawais.length; i++){
      if(pegawais[i].nama == name){
        $("#unitkerja").val(pegawais[i].unitKerja); // masih harus disesuaikan
        $("#nip").val(pegawais[i].noPegawai); // masih harus disesuaikan
        // $("#noTelp").val(pegawais[i].noTelp); // masih harus disesuaikan 
      }
    }
  }
  // melakukan pengecekan terhadap inputan waktu mulai dan selesai
  function checkSchedule(){
    const alertConflict = document.getElementById('alertConflict');
    const alertWrongInput = document.getElementById('alertWrongInput');
    const button = document.getElementById('btnSubmit');
    const aset_id = document.getElementById('aset').value;
    const start = new Date(document.getElementById('mulai').value);
    const end = new Date(document.getElementById('selesai').value);
    let booked = @json($booked);

    if(start > end){
      alertWrongInput.removeAttribute('hidden');
      button.setAttribute('hidden', '');
      alertConflict.setAttribute('hidden', '');
    } else {
      alertWrongInput.setAttribute('hidden', '');
      button.removeAttribute('hidden');
      for(i in booked){
        // filter data inside booked with same aset_id    
        if(aset_id == booked[i]['aset_id']){
          const mulai = new Date(booked[i]['mulai']);
          const selesai = new Date(booked[i]['selesai']);
          if((start >= mulai && start <= selesai) && (end <= selesai && end >= mulai)){ // di tengah tengah atau dalam range waktu yang sama sama
            button.setAttribute('hidden', '');
            alertConflict.removeAttribute('hidden');
          } else if(start < mulai && end > selesai){ // keadaan start lebih rendah dari mulai dan End lebih tinggi dari Selesai
            button.setAttribute('hidden', '');
            alertConflict.removeAttribute('hidden');
          } else if((start >= mulai && start <= selesai) && (end >= selesai)){ // keadaan start ada diantara mulai sama selesai, kemudian end lebih dari selesai
            button.setAttribute('hidden', '');
            alertConflict.removeAttribute('hidden');
          } else if((start <= mulai) && (end <= selesai && end >= mulai)){ // keadaan end berada di antara mulai sama selesai, kemudian start berada dibawah mulai
            alertConflict.removeAttribute('hidden');
            button.setAttribute('hidden', '');
          } else {
            alertConflict.setAttribute('hidden', '');
            button.removeAttribute('hidden');
          }
        }
      }
    }
  }
  // menampilkan button cek jadwal ketika memilih aset mana yang akan dipinjam
  function showSchedule(){
    var id = document.getElementById('aset').value;
    var button = document.getElementById('btnJadwal');
    button.removeAttribute('hidden');
    button.setAttribute('href', `/booked/${id}`);
  }

  function check(){
    if(document.getElementById('mulai').value != '' && document.getElementById('selesai').value != '' && (document.getElementById('ruangan').checked || document.getElementById('kendaraan').checked || document.getElementById('barang').checked)){
      document.getElementById('formPermohonan').action = '/permohonan-check';
      document.getElementById('formPermohonan').submit();
    }
  }

  function showPeriodForm(){
    if(document.getElementById('ruangan').checked || document.getElementById('kendaraan').checked || document.getElementById('barang').checked){
      document.getElementById('period').removeAttribute('hidden');
    } else if(!(document.getElementById('ruangan').checked || document.getElementById('kendaraan').checked || document.getElementById('barang').checked)){
      document.getElementById('period').setAttribute('hidden', '');
    }
  }

  function showOtherForm(){
    let namaPemohon = document.getElementById('namaPemohon').value;
    let unitkerja = document.getElementById('unitkerja').value;
    let noTelp = document.getElementById('noTelp').value;
    if(document.getElementById('ruangan').checked || document.getElementById('kendaraan').checked || document.getElementById('barang').checked){
      document.getElementById('otherForm').removeAttribute('hidden');
    } else if(!(document.getElementById('ruangan').checked || document.getElementById('kendaraan').checked || document.getElementById('barang').checked)){
      document.getElementById('otherForm').setAttribute('hidden', '');
    }
  }

</script>
<script>
  function hideButton() {
    var button1 = document.getElementById('btnSubmit');
    var button2 = document.getElementById('btn2');
    console.log(document.getElementById('namaPemohon').value);
    if(
      document.getElementById('namaPemohon').value != '' &&
      document.getElementById('unitkerja').value != '' &&
      document.getElementById('noTelp').value != '' &&
      document.getElementById('nip').value != '' &&
      document.getElementById('nama_email').value != '' &&
      document.getElementById('mulai').value != '' &&
      document.getElementById('selesai').value != '' &&
      document.getElementById('aset').value != '' &&
      document.getElementById('textbox').value != ''
    ) {
      console.log('berhasil');
      button1.style.display = 'none';
      button2.style.display = 'inline-block';
    }
  }
</script>



@endsection
    