<title>Diskominfo Jabar | Edit</title>
@extends('home.partials.main')

@section('container')
<!-- Profile -->
</div>
<div class="card col-lg-4 mx-auto mt-5">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="rounded-circle mx-auto d-block mt-2" src="{{ asset('assets/images/faces/face15.jpg') }}" alt="Image">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name text-center mt-1">
            <h5 class="mb-0 font-weight-normal">{{ auth()->user()->nama }}</h5>
            <span>{{ auth()->user()->hak_akses }}</span>
          </div>
      </div>
</div>
<!-- End Profile -->
<!-- Forms -->
<form action="/account/password/{{ auth()->user()->id }}" method="post">
  @csrf
  <div class="mb-3">
    <label for="password" class="form-label">Enter New Password</label>
    <input type="password" class="form-control" id="password" name='password'>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-danger" href="/dashboard" role="button">Kembali</a>
</form>
<!-- End Forms -->
@endsection