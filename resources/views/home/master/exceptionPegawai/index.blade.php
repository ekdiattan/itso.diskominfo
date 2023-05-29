@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-4 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah Pegecualian Untuk Pegawai</h4>
          <form action="/insert-pengecualian" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="nama">Nama Pegawai</label>
              <select class="form-control selectpicker" id="nip" name="nip" data-live-search="true">
              @foreach($pegawais as $pegawai)
                <option data-tokens="{{ $pegawai->noPegawai }}" value="{{ $pegawai->noPegawai }}">{{ $pegawai->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="mulai">Mulai</label>
              <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="mulai" name="mulai" required/>
            </div>
            <div class="form-group">
              <label for="selesai">Selesai</label>
              <input type="date" placeholder="dd-mm-yyyy" class="form-control" id="selesai" name="selesai" required/>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <input class="form-control" placeholder="Keterangan" aria-label="keterangan" name="keterangan">
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row justify-content-between">
            <h4 class="card-title mb-1">Daftar Keterangan Liburan</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Mulai</th>
                          <th>Selesai</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pengecualians as $pengecualian)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $pengecualian->nip }}</td>
                          <td>{{ $pengecualian->nama }}</td>
                          <td>{{ $pengecualian->keterangan }}</td>
                          <td>{{ $pengecualian->mulai}}</td>
                          <td>{{ $pengecualian->selesai}}</td>
                          <td>
                            <a href="/update-pengecualian/{{ $pengecualian->id }}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                            <form action="/delete-pengecualian/{{ $pengecualian->id }}" method="get" class="d-inline">
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
                            </form>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
  </script>
@endsection