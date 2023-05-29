<title>Diskominfo Jabar | Pengguna</title>
@extends('home.partials.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Data Pengguna</h2>
  </div>
                <div class="card">
                  <div class="card-body">  
                    <a class="btn btn-success" href="/register">+ Pengguna</a>
                  
                    <!-- <form action="/index" method="GET">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Masukan Nama" aria-label="Search" name="search">
                            <a href="/inventaris" style="margin-left: 5px; color: red;">Reset</a>
                        </form>
                    </form> -->
                    <div id="dataTable_wrapper" class="table-responsive">
                      <table id="dataTable" class="table table-hover">
                        <br>
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Nama Bidang</th>
                            <th>Hak Akses</th>
                            <th>Nomor HP</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $key => $post )  
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->nip }}</td>
                            <td>{{ $post->nama }}</td>
                            <td>{{ $post->nama_bidang}}</td>
                            <td>{{ $post->hak_akses }}</td>
                            <td>{{ $post->no_hp }}</td>
                            <td>
                              <a href="/register/{{ $post->id }}" class="badge bg-info">
                                <span class="menu-icon"><i class="far fa-eye"></i></span></a>
                                <a href="/register/edit/{{$post->id}}" class="badge bg-warning"><span
                                                class="menu-icon"><i class="far fa-edit"></i></span></a>
                              <form action="/register/delete/{{ $post->id }}" method="get" class="d-inline">
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span class="menu-icon"><i class="fas fa-trash"></i></span></button>
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
@endsection