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
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"readonly/>
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
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Tanggal Mulai Masuk</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="tanggalmulai" name="tanggalmulai" value="{{ $user->tanggalmulai }}"/>
              </div>
            </div>
          </div>
          <div class="col-md-6" id="emaill" style="display:none;">
            <div class="form-group row" >
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
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-9">
                <select class ="form-control" id="status" name="status">
                  <option value="{{$user->status}}">{{$user->status}}</option>
                  <option value="">--PILIH--</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            </div>
          </div>
          <div class="col-md-6" id="tanggalselesai">
            <div class="form-group row" >
              <label class="col-sm-3 col-form-label">Tanggal Selesai Masuk</label>
              <div class="col-sm-9 input-group-append">
                <input type="date" class="form-control" name="tanggalselesai" id="tanggalselesai" value="{{$user->tanggalselesai}}"/>
              </div>
            </div>
      </div>
      <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hak Akses</label>
              <div class="col-sm-9">
              <select class="form-control" id="hak_akses" name="hak_akses" value="{{$user->status}}">
                <option value="{{$user->hak_akses}}">{{$user->hak_akses}}</option>
                <option value="">--PILIH--</option>
                  @foreach ($role as $role)
                    <option>{{ $role->role }}</option>
                  @endforeach
                 </select>            
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
</div>
<div class="col-12 grid-margin">
  <form action="/register/update/{{ $user->id}}" method="POST">
    @csrf
    <div class="card">
      <div class="card-body">
      <p class="card-description">Edit Tampilan Dashboard </p>
    <!-- small box -->
  <div class="row">
    @foreach($mapping_dashboards as $mappingDashboard)
    <div class="col-md-4">
            <!-- small box -->
            <div class="small-box" style="background-color:{{$mappingDashboard->Warna}}">
              <div class="inner">
              <h3 style="color:white;">0</h3>
              <p style="color:white;">{{$mappingDashboard->NameCard}}</p>
              </div>
              <div class="icon">
              <i class="ion ion-checkmark"></i>
              </div>
              <div class="form-check" style="text-align: center;">
                  <input class="form-check-input bg-blue" type="checkbox" value="" id="flexCheckDefault" {{ $user->is_checked ? 'checked' : '' }}>
                  <label class="form-check-label" for="flexCheckDefault" name="is_checked" value="1" style="color:white;">Tampilkan</label>
              </div>
    </div>   
  </div>
  @endforeach
</div>
<button type="submit" class="btn btn-primary mr-2 btn-flat" id="submit-btn">Submit</button>
</div>
      <!-- end small box -->
    </div>
  </form>
</div>






         



<script src="../../assets/js/mata.js"></script>
<script src="../../assets/js/alertpasswordregister.js"></script>

<script>
  // Mendapatkan elemen <select> dan <div> form alasan
  var hakAksesSelect = document.getElementById('hak_akses');
  var aktifselect = document.getElementById('statuskeaktifan');
  var formtanggalselesai = document.getElementById('tanggalselesai');
  var formAlasan = document.getElementById('emaill');


  aktifselect.addEventListener('change', function(){
    var pilihnilai = aktifselect.value;

    if (pilihnilai === 'Tidak Aktif'){
      formtanggalselesai.style.display = 'block';
    }else{
      formtanggalselesai.style.display = 'none';
    }
  });

  

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

<script>
  function check() {
    document.getElementById("flexCheckDefault").checked = true;
}
function uncheck() {
    document.getElementById("flexCheckDefault").checked = false;
}
</script>


@endsection