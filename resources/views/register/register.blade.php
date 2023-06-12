@extends('home.partials.main')
@section('container')
<link rel="stylesheet" href="">
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
         <form action="/register" method="post" enctype="multipart/form-data">
          <p class="card-description">Register</p>
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label>NIP</label>
                      <input type="text" class="form-control p_input" id="nip" name="nip">
                    </div>
                    <div class="col-sm-6">
                      <label>Username</label>
                      <input  type="text" class="form-control p_input" id="username" name="username" >
                      <div id="username-message"></div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label>Nama</label>
                      <input type="text" class="form-control p_input" id="nama" name="nama">
                    </div>
                    <div class="col-sm-6">
                      <label>Jabatan</label>
                      <input  type="text" class="form-control p_input" id="jabatan" name="jabatan" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleFormControlSelect2">Unit Kerja</label>
                        <select class="form-control" id="unitkerja" name="unitkerja">
                          @foreach ($unitkerja as $unitkerja)
                          <option value="{{ $unitkerja->namaUnit }}">{{ $unitkerja->namaUnit }}</option>
                          @endforeach  
                        </select>
                    </div>
                    <div class="col-sm-6">
                      <label for="exampleFormControlSelect2">Hak Akses</label>
                      <select class="form-control" id="hak_akses" name="hak_akses">
                          @foreach ($role as $role)
                            <option value="{{ $role->role }}">{{ $role->role }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label>Nomor HP</label>
                      <input type="text" class="form-control p_input" id="no_hp" name="no_hp">
                    </div>
                    <div class="col-sm-6">
                      <label>Foto Profile</label>
                      <input type="file" class="form-control p_input" id="image" name="image">
                    </div>
                    <div class="col-sm-6" id="emaill" style="display:none;">
                      <label>Email</label>
                      <input type="email" class="form-control p_input" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="col-sm-6">
                      <label>Password</label>
                      <div class="input-group-append">
                        <input  type="password" class="form-control p_input" id="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" >
                        <span class="input-group-text" >
                        <i class="far fa-eye" id="show-password" type="button" ></i>
                      </span>
                    </div>
                    <div id="password-strength"></div>
                    </div>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn" id="submit-btn">Buat</button>
                  </div>
                </form>
              </div>
            </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
  <script>
       // Mendapatkan elemen <select> dan <div> form alasan
   var roleSelect = document.getElementById('hak_akses');
   var reasonForm = document.getElementById('emaill');

   // Menambahkan event listener untuk perubahan pada opsi yang dipilih
   roleSelect.addEventListener('change', function () {
       var selectedValue = roleSelect.value;

       // Menampilkan/sembunyikan form alasan berdasarkan kondisi
       if (selectedValue === 'Aset') {
           reasonForm.style.display = 'block'; // Merubah 'block' menjadi 'none'
       } else {
           reasonForm.style.display = 'none';
       }
   });
  </script>
    <script src="../../assets/js/mata.js"></script>
    <script src="../../assets/js/password.js"></script>
@endsection
