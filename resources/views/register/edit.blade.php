@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/register/update/{{ $user->id }}" method="post">
        @csrf
        <p class="card-description">Edit Data Pengguna </p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nip</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $user->nip }}" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row" style="display:none;" id="emaill">
              <label class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9 input-group-append">
              <input type="text" class="form-control p_input" id="email" name="email" value="{{$user->email}}">
            </div>
            </div>
        </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jabatan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $user->jabatan }}"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Bidang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="{{ $user->nama_bidang }}"/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">No Hp</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}"/>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hak Akses</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="hak_akses" name="hak_akses" value="{{ $user->hak_akses }}"/>
            </div>
          </div>
      </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9 input-group-append">
              <input  type="password" class="form-control p_input" id="password" name="password" placeholder ="Isi dengan sandi baru jika ingin merubahnya">
              <span class="input-group-text" >
                    <i class="far fa-eye" id="show-password" type="button" ></i>
              </span>
            </div>
            </div>
        </div>
          <div class="box">
            <div class="box-header with-border">
                <a href="{{url('/index') }}" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
                <button type="submit" class="btn btn-primary mr-2 btn-flat" id="submit-btn">Submit</button>
            </div>
        </div>
      </form>
      <div id="password-strength"></div>

    </div>
  </div>
</div>

<script src="../../assets/js/mata.js"></script>
<script src="../../assets/js/alertpasswordregister.js"></script>

<script>
  // Mendapatkan elemen <select> dan <div> form alasan
  var hakAksesSelect = document.getElementById('hak_akses');
  var formAlasan = document.getElementById('emaill');

  // Menambahkan event listener untuk perubahan pada opsi yang dipilih
  hakAksesSelect.addEventListener('change', function () {
    var selectedValue = hakAksesSelect.value;

    // Menampilkan/sembunyikan form alasan berdasarkan kondisi
    if (selectedValue === 'Aset') {
      formAlasan.style.display = 'block';
    } else {
      formAlasan.style.display = 'none';
    }
  });

  // Memeriksa nilai awal pada saat halaman dimuat
  if (hakAksesSelect.value === 'Aset') {
    formAlasan.style.display = 'block';
  }
</script>



@endsection