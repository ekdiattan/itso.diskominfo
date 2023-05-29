@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')

<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" style="color:black;"><h2>Edit Inventaris<h2></li>
  </ol>
  
<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
      <form action="/inventaris-update/{{ $edit->id }}" method="post">
        @csrf
          <table class="table">
            <h5><?php echo "Data Barang "?></h5>
            <tr>
              <td>Merk</td>
              <td>:</td>
              <td> <select class="form-control" id="merk" name="merk">
                @foreach ($merk as $merk)
                      <option value="{{ $merk->merk }}" {{($edit->merk === $merk->merk)?'selected':''}}>{{ $merk->merk }} </option>
                      @endforeach
                  </select></td>
            </tr>
            <tr>
              <td>Tipe</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="tipe" id="tipe" autocomplete="off"  size="30"  value="{{ $edit ->tipe }}" required></td>
            </tr>
            <tr>
              <td>Nama Barang</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="namaBarang" id="namaBarang" autocomplete="off"  size="30"  value="{{ $edit ->namaBarang }}" required></td>
            </tr>
            <tr>
              <td>Kondisi Barang</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="kondisiBarang" id="kondisiBarang" autocomplete="off"  size="30"  value="{{ $edit ->kondisiBarang }}" required></td>
            </tr>
            <tr>
              <td>Gambar</td>
              <td>:</td>
              <td><a href="/images/inventaris/{{$edit->image}}" target="_blank"><img src="{{ asset('images/inventaris/'.$edit->image)}}" class="img-thumbnail" style="margin-left:-50px;"></a></td>
            </tr>
          </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
          <table class="table">
          <h5><?php echo "Data Sertifikat" ?></h5>
          <tr>
          <td>No Sertifikat</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="noSertifikat" id="noSertifikat" autocomplete="off"  size="30"  value="{{ $edit ->noSertifikat }}"></td>
        </tr>
        <tr>
          <td>Lokasi</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="lokasi" id="lokasi" autocomplete="off"  size="30"  value="{{ $edit ->lokasi }}" ></td>
        </tr>
        <tr>
          <td>Cara Perolehan</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="caraPerolehan" id="caraPerolehan" autocomplete="off"  size="30"  value="{{ $edit ->caraPerolehan }}" ></td>
        </tr>
        <tr>
          <td>Bulan Perolehan</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="bulanPerolehan" id="bulanPerolehan" autocomplete="off"  size="30"  value="{{ $edit ->bulanPerolehan }}"></td>
        </tr>
        <tr>
          <td>Tahun Perolehan</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="tahunPerolehan" id="tahunPerolehan" autocomplete="off"  size="30"  value="{{ $edit ->tahunPerolehan }}" ></td>
        </tr>
          </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
          <table class="table">
            <h5><?php echo "Data Tambahan" ?></h5>
            <input type="hidden" class="form-control" name="kodeBarang" id="kodeBarang" autocomplete="off"  value="{{ $edit ->kodeBarang }}" >
            <tr>
              <td>Kuantitas</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="kuantitas" id="kuantitas" autocomplete="off"  size="30"  value="{{ $edit ->kuantitas }}"></td>
            </tr>
            <tr>
              <td>Satuan</td>
              <td>:</td>
              <td> <select class="form-control" id="satuan" name="satuan"   value="{{ $edit ->satuan }}">
                @foreach ($satuan as $satuan)
                      <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }} </option>
                      @endforeach
                  </select></td>
            </tr>
            <tr>
              <td>Harga Satuan</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="hargaSatuan" id="hargaSatuan" autocomplete="off"  size="30"  value="{{ $edit ->hargaSatuan }}" ></td>
            </tr>
            <tr>
              <td>Nilai Perolehan</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="nilaiPerolehan" id="nilaiPerolehan" autocomplete="off"  size="30"  value="{{ $edit ->nilaiPerolehan }}"></td>
            </tr>
            <tr>
              <td>Umur Ekonomis</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="umurEknomis" id="umurEknomis" autocomplete="off"  size="30"  value="{{ $edit ->umurEkonomis }}"></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td><input type="text" class="form-control" name="keterangan" id="keterangan" autocomplete="off"  size="30"  value="{{ $edit ->keterangan }}" ></td>
            </tr>
          </table>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-body">
          <table class="table">
          <h5><?php echo "Data Pengguna" ?></h5>
          <tr>
          <td>Nama Pengguna</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="namaPengguna" id="namaPengguna" autocomplete="off"  size="30"  value="{{ $edit ->namaPengguna }}"></td>
        </tr>
        <tr>
          <td>No Hp</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="noHp" id="noHp" autocomplete="off"  size="30"  value="{{ $edit ->noHp }}"></td>
        </tr>
        <tr>
          <td>No Berita Acara</td>
          <td>:</td>
          <td><input type="text" class="form-control" name="noBeritaAcara" id="noBeritaAcara" autocomplete="off"  size="30"  value="{{ $edit ->noBeritaAcara }}" ></td>
        </tr>
          </table>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <a class="btn btn-danger" href="/inventaris" role="button">Kembali</a>
        <td><button type="submit" class="btn btn-primary mr-2" style="margin-left:10px;">Submit</button></td>
      </div>
    </div>
  </div>
</div>
</form>


@endsection