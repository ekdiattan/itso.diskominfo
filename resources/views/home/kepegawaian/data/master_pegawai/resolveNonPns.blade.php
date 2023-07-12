@extends('home.partials.main')
@section('container')
<div class="container-fluid">
    <form action="/pegawai-resolve/{{ $local->user_id }}" method="post">
    @csrf
    <div class="card m-3">
        <div class="card-header">
            <h2>Tinjau Data Pegawai</h2>
        </div>
        <div class="card-body">
            <table class="table table-sm table-responsive-sm table-borderless">
                <thead class="border-bottom">
                    <td scope="col"></td>
                    <td scope="col"><b>Versi Lama</b></td>
                    <td scope="col"><b>Versi Baru</b></td>
                </thead>

                <tbody class="table-group-divider">
                    @foreach($keys as $key)
                    @if($api->$key != null && $api->$key != $local->$key)
                    <tr>
                        <td scope="row" class="text-start"><b>{{ $key }}</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="{{ $key }}" id="{{ $key }}1" value="{{ $local->$key }}"> {{ $local->$key }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="{{ $key }}" id="{{ $key }}2" value="{{ $api->$key }}"> {{ $api->$key }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <h2>Hasil Tinjauan</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped table-responsive">
                <thead class="bg-gray disabled color-palette">                          
                    <tr>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Pernikahan</th>
                        <th>Agama</th>
                        <th>Golongan Darah</th>
                        <th>Gender</th>
                        <th>Usia</th>
                        <th>Telepon</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Tanggal Bergabung</th>
                        <th>Tanggal Resign</th>
                        <th>Alasan Resign</th>
                        <th>Alamat KTP</th>
                        <th>Alamat Saat Ini</th>
                        <th>No Rekening</th>
                        <th>Nama Bank</th>
                        <th>Cabang Bank</th>
                        <th>NPWP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($keys as $key)
                        <td class="text-left"><p id="t{{ $key }}">{{ $local->$key }}</p></td>
                        @endforeach
                    </tr>
                </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
<script>
    function setIntoTable(){
        let keys = @json($keys);
        for(let i = 0; i < keys.length; i++){
            let variable = "let " + keys[i] + " = " + " document.getElementById(t" + keys[i] + ")";
            eval(variable);
        }
        for(let i = 0; i < keys.length; i++){
            if(document.querySelector(`input[name=${keys[i]}]:checked`) != null){
                let variable = `t${keys[i]}.innerHTML = document.querySelector('input[name=${keys[i]}]:checked').value;`
                eval(variable);
            }
        }
    }
</script>