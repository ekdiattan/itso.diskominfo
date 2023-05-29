@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <div class="btn-group btn-group-vertical">
                        <a href="/master-pegawai" class="btn btn-social btn-flat btn-warning btn-xs"><i
                                class="fa fa-arrow-circle-o-left"></i> Kembali ke Data Pegawai</a>
                    </div>
                </div>

                @if (session()->has('success'))
                    <div class="box-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    </div>
                @endif
                <br>
                <form action="/store-data-pegawai" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <code> (Dengan Gelar) </code> </label>
                                    <input id="nama" name="nama" class="form-control input-sm required nama"
                                        maxlength="100" type="text" placeholder="Nama Lengkap" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="tempatLahir">Tempat Lahir</label>
                                    <input id="tempatLahir" name="tempatLahir" class="form-control input-sm required nik"
                                        type="text" placeholder="Tempat Lahir" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="tanggalLahir">Tanggal Lahir</label>
                                    <input id="tanggalLahir" name="tanggalLahir" class="form-control input-sm required"
                                        type="date" placeholder="Tanggal Lahir" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="noPegawai">NIP</label>
                                    <input id="noPegawai" name="noPegawai" class="form-control input-sm required"
                                        type="number" placeholder="NIP" value="">
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="unitkerja_nama">Unit Kerja </label>
                                    <select class="form-control input-sm required" name="unitkerja_nama"
                                        id="unitkerja_nama">
                                        <option value="">Pilih Unit Kerja </option>
                                        @foreach($bidangs as $bidang)
                                            <option value="{{ $bidang->namabidang }}">{{ $bidang->namabidang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="jabatan">Golongan Pangkat</label>
                                    <select class="form-control input-sm required" name="jabatan" id="jabatan">
                                        <option value="">Pilih Jabatan </option>
                                        <option value="DIREKSI">DIREKSI</option>
                                        <option value="DIREKTUR UTAMA">DIREKTUR UTAMA</option>
                                        <option value="DIREKTUR">DIREKTUR</option>
                                        <option value="HR & PERSONALIA">HR & PERSONALIA</option>
                                        <option value="MANAJER">MANAJER</option>
                                        <option value="SUPERVISOR">SUPERVISOR</option>
                                        <option value="STAFF">STAFF</option>
                                        <option value="ADMINISTRASI">ADMINISTRASI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">TMT Golongan</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Eselon</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Nama Jabatan</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">TMT Jabatan</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="status_pegawai">Status Pegawai </label>
                                    <select class="form-control input-sm required" name="status_pegawai" id="status_pegawai">
                                        <option value="">Pilih Status Pegawai </option>
                                        <option value="PNS">PNS</option>
                                        <option value="CPNS">CPNS</option>
                                        <option value="Karyawan Kontrak">Non-PNS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="no_telp">TMT Pegawai</label>
                                    <input id="no_telp" name="no_telp" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor Telepon" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Masa Kerja Tahun</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Masa Kerja Bulan</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin </label>
                                    <select class="form-control input-sm required" name="gender" id="gender">
                                        <option value="">Pilih Jenis Kelamin </option>
                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="agama">Agama </label>
                                <select class="form-control input-sm required" id="agama" name="agama">
                                        <option value="">Pilih Agama </option>
                                        <option value="ISLAM">ISLAM</option>
                                        <option value="KRISTEN">KRISTEN</option>
                                        <option value="KHATOLIK">KHATOLIK</option>
                                        <option value="HINDU">HINDU</option>
                                        <option value="BUDHA">BUDHA</option>
                                        <option value="KEPERCAYAAN PADA TUHAN YME/LAINNYA">KEPERCAYAAN PADA TUHAN
                                            YME/LAINNYA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Perkawinan</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Pendidikan Awal</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Jurusan Pendidikan Awal</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Pendidikan Akhir</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Jurusan Pendidikan Akhir</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">No Askes</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">No NPWP</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">NIK</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat Rumah</label>
                                    <textarea id="alamat" name="alamat" class="form-control input-sm" rows="5" placeholder="Alamat Pegawai"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Telpon</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">No HP</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">E-mail</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nip">Kedudukan Pegawai</label>
                                    <input id="nip" name="nip" class="form-control input-sm required nik"
                                        type="text" placeholder="Nomor NIP" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i
                                class="fa fa-times"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i
                                class="fa fa-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
