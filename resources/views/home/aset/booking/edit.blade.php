@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<form action="/booking-update/{{ $edit->id }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body"> 
            <br>
            <div class="form-group">
                <label for="exampleInputUsername1">No Tiket</label>
                <input type="text" class="form-control" id="tiket" name="tiket"  maxlength="255" value="{{$edit->tiket}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Nama Pemohon</label>
                <input type="text" class="form-control" id="namaPemohon" name="namaPemohon"  maxlength="255" value="{{$edit->namaPemohon}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">No Telepon</label>
                <input type="text" class="form-control" id="noTelp"  name="noTelp" maxlength="255" value="{{$edit->noTelp}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Bidang</label>
                <input type="text" class="form-control" id="bidang" name="bidang"  maxlength="255" value="{{$edit->getBidang->namaUnit}}" readonly>
            </div>
        </div>
    </div>
    <div class="card">
        <input type="submit" class="btn btn-primary" id="button1" onclick="hideButton()">
        <button class="btn btn-primary" type="button" id="button2" style="display:none;">
              <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
              <span class="spinner-grow spinner-grow-sm text-warning" role="status" aria-hidden="true"></span>
              <span class="spinner-grow spinner-grow-sm text-success" role="status" aria-hidden="true"></span>
        </button>
    </div>
</div>
<div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Mulai</label>
                <input type="text" class="form-control" id="mulai" name="mulai" value="{{$edit->mulai}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Selesai</label>
                <input type="text" class="form-control" id="selesai" name="selesai" value="{{$edit->selesai}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Perihal</label>
                <input type="text" class="form-control" id="perihal" name="perihal" value="{{$edit->perihal}}" readonly>
            </div>
            <div class="form-group">
                <label for="suratPermohonan">Surat Permohonan</label>
                <input class="form-control" type="file" id="suratPermohonan" name="suratPermohonan" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Tanggal Permohonan</label>
                <input type="text" class="form-control" id="tanggalPermohonan" name="tanggalPermohonan" value="{{$edit->tanggalPermohonan}}" readonly>
            </div>
            <!-- <div class="form-group">
                <label for="exampleInputUsername1">Hostname</label>
                <input type="text" class="form-control" id="hostname" name="hostname" value="{{$edit->hostname}}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Ip</label>
                <input type="text" class="form-control" id="ip" name="ip" value="{{$edit->ip}}" readonly>
            </div> -->


            <div class="form-group">
                <label for="exampleInputUsername1">Status</label>
                <select class="form-control" id="status" name="status" onchange="ShowHideReason()" required>
                    <option value="">---PILIH---</option>
                    <option value="Disetujui">Setujui</option>
                    <option value="Ditolak">Tolak</option>
                </select>
            </div>
            <!-- Menggunakan javascript untuk alasan -->
            <div class="form-group" style="display:none;" id="alasan-container">
                <label for="exampleInputUsername1">Alasan </label>
                <textarea type="text" class="form-control" id="alasan" name="alasan" value="{{$edit->alasan}}"></textarea>
            </div>
        </div>
      </div>
</form>
<script>
    function ShowHideReason() {
        let status = document.getElementById("status");
        let container = document.getElementById("alasan-container");
        let alasan = document.getElementById('alasan');
        if(status.value == "Ditolak") {
            container.style.display = "block";
            alasan.setAttribute('required', '');
        } else {
            container.style.display = "none";
            alasan.removeAttribute('required');
        }
    }
</script>

<script>
   function hideButton() {
    var button1 = document.getElementById('button1');
    var button2 = document.getElementById('button2');
    if(
      document.getElementById('tiket').value != '' &&
      document.getElementById('namaPemohon').value != '' &&
      document.getElementById('noTelp').value != '' &&
      document.getElementById('bidang').value != '' &&
      document.getElementById('mulai').value != '' &&
      document.getElementById('selesai').value != '' &&
      document.getElementById('perihal').value != '' &&
      document.getElementById('tanggalPermohonan').value != '' &&
      document.getElementById('status').value != '' &&
      document.getElementById('suratPermohonan').value != ''
    ) {
      button1.style.display = 'none';
      button2.style.display = 'inline-block';
    }
  }
</script>
@endsection