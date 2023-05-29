@extends('home.partials.main')
@section('container')
<!-- Profile -->

      <div class="profile-desc mt-2">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="rounded-circle mx-auto d-block " src="{{ $user->image ?? asset('assets/images/faces/face15.jpg') }}" alt="image">
            <span class="count bg-success"></span>
          </div>
         <div class="profile-name text-center">
            <h5 class="mt-4 font-weight-normal">{{ auth()->user()->nama }}</h5>
            <span>{{ auth()->user()->hak_akses }}</span>
          </div>
          <form action='/account/{{ $user->id }}' method="post">
  <!-- <fieldset> -->
              <div class="mb-3 p-3">
                <h4>Username</h4>
                <h5>{{ auth()->user()->username }}</h5>
              </div>
              <br>
              <div class="mb-3 p-3">
              <h4>Nama</h4>
                <h5>{{ auth()->user()->nama }}</h5>
              </div>
              <br>
              <div class="mb-3 p-3">
                <h4>Hak Akses</h4>
                <h5>{{ auth()->user()->hak_akses }}</h5>
              </div>
              <br>
              <div class="mb-3 p-3">
                <h4>NIP</h4>
                <h5>{{ auth()->user()->nip }}</h5>
              </div>
              <br>
              <div class="mb-3 p-3">
                <h4>Jabatan</h4>
                <h5>{{ auth()->user()->jabatan }}</h5>
              </div>
              <br>
              <div class="mb-3 p-3">
                <h4>No HP</h4>
                <h5>{{ auth()->user()->no_hp }}</h5>
              </div>

      <!-- Baru dikomen 8 mei 2023 -->
      <form action="/profile/{{$user->id}}" method="post"enctype="multipart/form-data">
        @csrf
      </form>
     <br>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div> 
      @endif

      <form action="/register/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
            <label for="password"> Ganti Foto Profile</label>
              <input  type="file" class="form-control" id="image" name="image">
            </div>
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary mr-2 btn-flat float-right" id="submit">Change</button>
            </div>
              <label for="password"> Ganti Password</label>
              <input  type="password" class="form-control" id="password" name="password" placeholder ="Masukan kata sandi baru">
            </div>
            <div id="password-strength"></div>
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary mr-2 btn-flat float-right" id="submit-btn">Change</button>
              <span class="input-group-text" >
                        <i class="far fa-eye" id="show-password" type="button" ></i>
            </div>
            <div class="form-group">
            
      </form> 

<!-- End Profile -->

<!-- Info -->
  <script src="../../assets/js/mata.js"></script>
  <script src="../../assets/js/password.js"></script>

@endsection