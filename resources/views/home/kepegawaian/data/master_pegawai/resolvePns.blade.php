@extends('home.partials.main')
@section('container')
<div class="container-fluid">
    <form action="/pegawai-resolve/{{ $local->noPegawai }}" method="post">
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
                    @if($api->nama != null && $api->nama != $local->nama)
                    <tr>
                        <td scope="row" class="text-start"><b>Nama</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="nama" id="name1" value="{{ $local->nama }}"> {{ $local->nama }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="nama" id="name2" value="{{ $api->nama }}">  {{ $api->nama }}</td>
                    </tr>
                    @endif
                    @if($api->tempatLahir != null && $api->tempatLahir != $local->tempatLahir)
                    <tr>
                        <td scope="row" class="text-start"><b>Tempat Lahir</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="tempatLahir" id="tempatlahir1" value="{{ $local->tempatLahir }}"> {{ $local->tempatLahir }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="tempatLahir" id="tempatlahir2" value="{{ $api->tempatLahir }}"> {{ $api->tempatLahir }}</td>
                    </tr>
                    @endif
                    @if($api->tanggalLahir != null && $api->tanggalLahir != $local->tanggalLahir)
                    <tr>
                        <td scope="row" class="text-start"><b>Tanggal Lahir</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="tanggalLahir" id="tanggallahir1" value="{{ $local->tanggalLahir }}"> {{ $local->tanggalLahir }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="tanggalLahir" id="tempatlahir2" value="{{ $api->tanggalLahir }}"> {{ $api->tanggalLahir }}</td>
                    </tr>
                    @endif
                    @if($api->noPegawai != null && $api->noPegawai != $local->noPegawai)
                    <tr>
                        <td scope="row" class="text-start"><b>NIP</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="noPegawai" id="nip1" value="{{ $local->noPegawai }}"> {{ $local->noPegawai }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="noPegawai" id="nip2" value="{{ $api->noPegawai }}"> {{ $api->noPegawai }}</td>
                    </tr>
                    @endif
                    @if($api->unitKerja != null && $api->unitKerja != $local->unitKerja)
                    <tr>
                        <td scope="row" class="text-start"><b>Unit Kerja</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="unitKerja" id="unitkerja1" value="{{ $local->unitKerja }}"> {{ $local->unitKerja }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="unitKerja" id="unitkerja2" value="{{ $api->unitKerja }}"> {{ $api->unitKerja }}</td>
                    </tr>
                    @endif
                    @if($api->kedudukanPegawai != null && $api->kedudukanPegawai != $local->kedudukanPegawai)
                    <tr>
                        <td scope="row" class="text-start"><b>Kedudukan Pegawai</b></td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="kedudukanPegawai" id="kedudukan1" value="{{ $local->kedudukanPegawai }}"> {{ $local->kedudukanPegawai }}</td>
                        <td scope="row" class="text-start"><input onChange="setIntoTable();" type="radio" name="kedudukanPegawai" id="kedudukan2" value="{{ $api->kedudukanPegawai }}"> {{ $api->kedudukanPegawai }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <h2>Hasil Tinjauan</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped table-responsive-lg">
                <thead class="bg-gray disabled color-palette">                          
                    <tr>
                        <th width="25%">Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>NIP</th>
                        <th>Unit Kerja</th>
                        <th>Kedudukan Pegawai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><p id="tnama">{{ $local->nama }}</p></td>
                        <td class="text-left"><p id="ttempatlahir">{{ $local->tempatLahir }}</p></td>
                        <td class="text-left"><p id="ttanggallahir">{{ $local->tanggalLahir }}</p></td>
                        <td class="text-left"><p id="tnopegawai">{{ $local->noPegawai }}</p></td>
                        <td class="text-left"><p id="tunitkerja">{{ $local->unitKerja }}</p></td>
                        <td class="text-left"><p id="tkedudukanpegawai">{{ $local->kedudukanPegawai }}</p></td>
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
        let tnama = document.getElementById('tnama');
        let ttempatlahir = document.getElementById('ttempatlahir');
        let ttanggallahir = document.getElementById('ttanggallahir');
        let tnopegawai = document.getElementById('tnopegawai');
        let tunitkerja = document.getElementById('tunitkerja');
        let tkedudukanpegawai = document.getElementById('tkedudukanpegawai');
        if(document.querySelector('input[name="nama"]:checked') != null){
            tnama.innerHTML = document.querySelector('input[name="nama"]:checked').value;
        }
        if(document.querySelector('input[name="tempatLahir"]:checked') != null){
            ttempatlahir.innerHTML = document.querySelector('input[name="tempatLahir"]:checked').value;
        }
        if(document.querySelector('input[name="tanggalLahir"]:checked') != null){
            ttanggallahir.innerHTML = document.querySelector('input[name="tanggalLahir"]:checked').value;
        }
        if(document.querySelector('input[name="noPegawai"]:checked') != null){
            tnopegawai.innerHTML = document.querySelector('input[name="noPegawai"]:checked').value;
        }
        if(document.querySelector('input[name="unitKerja"]:checked') != null){
            tunitkerja.innerHTML = document.querySelector('input[name="unitKerja"]:checked').value;
        }
        if(document.querySelector('input[name="kedudukanPegawai"]:checked') != null){
            tkedudukanpegawai.innerHTML = document.querySelector('input[name="kedudukanPegawai"]:checked').value;
        }
    }
</script>