@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" style="color:black;"><h2>Inventaris<h2></li>
  </ol>
  
<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
      <form action="/inventaris/store" method="post" enctype="multipart/form-data">
        @csrf
        <h5>Data Barang</h5>
        <label class="col-sm-3 col-form-label">Kode Barang</label>
          <input type="text" class="form-control" onChange="aset()" name="kodeBarang" id="kodeBarang" autocomplete="off"  size="30" readonly>
        <label class="col-sm-3 col-form-label">Jenis Aset</label>
          <select class="form-control" id="jenisAset" name="jenisAset" >
              <option value="">--pilih--</option>
            @foreach ($kodeBarang as $kodeBarang)
              <option value="{{$kodeBarang->jenisAset}}">{{$kodeBarang->jenisAset}}</option>
            @endforeach
          </select>
        <label class="col-sm-3 col-form-label">Merk</label>
          <select class="form-control" id="merk" name="merk" >
              <option value="">--pilih--</option>
            @foreach ($merk as $merk)
                <option value="{{ $merk->merk }}">{{ $merk->merk }} </option>
            @endforeach
          </select>
        <label class="col-sm-3 col-form-label">Tipe</label>
          <input type="text" class="form-control" name="tipe" id="tipe" autocomplete="off"  size="30" required>
        <label class="col-sm-3 col-form-label">Nama Barang</label>
          <input type="text" class="form-control" onChange() name="namaBarang" id="namaBarang" autocomplete="off"  size="30" required readonly>
        <label class="col-sm-3 col-form-label">Kondisi Barang</label>
          <input type="text" class="form-control" name="kondisiBarang" id="kondisiBarang" autocomplete="off"  size="30" required>
        <label class="col-sm-3 col-form-label">Image</label>
          <input type="file" class="form-control" name="image" id="image" autocomplete="off"  size="30" required>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5>Data Aset</h5>
        <label class="col-sm-3 col-form-label">No Sertifikat</label>
          <input type="text" class="form-control" name="noSertifikat" id="noSertifikat" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Lokasi</label>
          <input type="text" class="form-control" name="lokasi" id="lokasi" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Cara Perolehan</label>
          <input type="text" class="form-control" name="caraPerolehan" id="caraPerolehan" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Bulan Perolehan</label>
          <input type="text" class="form-control" name="bulanPerolehan" id="bulanPerolehan" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Tahun Perolehan</label>
          <input type="text" class="form-control" name="tahunPerolehan" id="tahunPerolehan" autocomplete="off"  size="30" >
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5>Data Tambahan</h5>
        <input type="hidden" class="form-control" name="kodeBarang" id="kodeBarang" autocomplete="off" >
        <label class="col-sm-3 col-form-label">Kuantitas</label>
          <input type="text" class="form-control" name="kuantitas" id="kuantitas" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Satuan</label>
          <select class="form-control" id="satuan" name="satuan">
              <option value="">--pilih--</option>
            @foreach ($satuan as $satuan)
              <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }} </option>
            @endforeach
          </select>
        <label class="col-sm-3 col-form-label">Harga Satuan</label>
          <input type="text" class="form-control" name="hargaSatuan" id="hargaSatuan" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Nilai Perolehan</label>
          <input type="text" class="form-control" name="nilaiPerolehan" id="nilaiPerolehan" autocomplete="off"  size="30" >
        <label class="col-sm-3 col-form-label">Umur Ekonomis</label>
          <input type="text" class="form-control" onChange() name="umurEknomis" id="umurEknomis" autocomplete="off"  size="30" readonly>
        <label class="col-sm-3 col-form-label">Keterangan</label>
          <input type="text" class="form-control" name="keterangan" id="keterangan" autocomplete="off"  size="30" >
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
        <h5>Data Pengguna</h5>
        <label class="col-sm-3 col-form-label">Nama Pengguna</label>
          <input type="text" class="form-control" name="namaPengguna" id="namaPengguna" autocomplete="off" size="30">
        <label class="col-sm-3 col-form-label">Nomer HP</label>
          <input type="text" class="form-control" name="noHp" id="noHp" autocomplete="off" size="30">
        <label class="col-sm-3 col-form-label">Nomer Berita Acara</label>
          <input type="text" class="form-control" name="noBeritaAcara" id="noBeritaAcara" autocomplete="off" size="30">
      </div>
    </div>    
    <div class="card mb-4">
      <div class="card-body">
        <a class="btn btn-danger" href="/inventaris" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary mr-2" style="margin-left:10px;">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
function aset(){
  var cekAset = dokumen.getElementById("id").value;
  document.getElementById("kodeBarang").value = cekAset.namaBarang;
}
</script>
@endsection