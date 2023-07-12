@extends('home.partials.main')
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
          <h4 for="exampleInputUsername1">Tambahkan Dashboard Widget</h4>
          <form action="/map/create" method="post" >
            @csrf
            <br>
            <div class="form-group">
              <label for="exampleInputUsername1" class="">Nama Widget</label>
              <input type="text" class="form-control" id="NameCard" name="NameCard" required>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Warna Widget</label>
              <input type="color" class="form-control" id="Warna" name="Warna" required>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Tujuan Widget</label>
              <select class="form-control selectpicker" aria-label="Default select example" id="Route" name="Route" required>
                  <option value="">--PILIH--</option>
                  <option value="/laporan">Catatan IT</option>
                  <option value="/booking">Aset - Peminjaman</option>
                  <option value="/inventaris">Aset - Inventaris</option>
                  <option value="/master-pegawai">Kepegawaian - Master Pegawai</option>
                  <option value="/keamanan">Keamanan - Peminjaman</option>
                  <option value="/kodeAset">Master - Aset</option>
                  <option value="/unitkerja">Master - Unit Kerja</option>
                  <option value="/kategori">Master - Kategori</option>
                  <option value="/pengecualian">Master - Pengecualian Pegawai</option>
                  <option value="/role">Master - Role</option>
                  <option value="/merk">Master - Merk</option>
                  <option value="/satuan">Master - Satuan</option>
                  <option value="/libur">Master - Liburan</option>
              </select>
            </div>
            <div class="form-group">
            <label for="exampleInputUsername1">Tujuan Tabel</label>
              <select class="form-control selectpicker" data-live-search="true" aria-label="Default select example" id="Table" name="Table" required>
                <option value="">--PILIH--</option>
                  @foreach($tables as $table)
                  <option value="{{$table}}">{{$table}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
            <label for="exampleInputUsername1">Query</label>
              <select class="form-control selectpicker " aria-label="Default select example" id="Query" name="Query" required>
                  <option value="">--PILIH--</option>
                  <option value="count">Count</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputUsername1">Kondisi</label>
              <input type="text" class="form-control" id="Kondisi" name="Kondisi">
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
            <h4 class="card-title mb-1">Daftar Dashboard</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="preview-list">
                <div id="dataTable_wrapper" class="table-responsive">
                    <table id="dataTable" class="table table-hover table-bordered table-striped">
                      <thead  class="bg-gray disabled color-palette">
                        <tr>
                          <th>No</th>
                          <th>Nama Widget</th>
                          <th>Warna Widget</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($mapping_dashboards as $post )  
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $post->NameCard }}</td>
                          <td>{{ $post->Warna }}</td>
                          <td>
                            <a href="/mappingDashboard-edit/{{$post->id}}" class="badge bg-warning"><span class="menu-icon"><i class="far fa-edit"></i></span></a>
                           
                            <form action="/mappingDashboard-dlt/{{$post->id}}" method="get" class="d-inline">
                                @method('delete')
                                @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"  ><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
                            </form>
                          
                          </td>
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
  
@endsection