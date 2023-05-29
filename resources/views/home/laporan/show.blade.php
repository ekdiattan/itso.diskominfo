@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <p class="card-description">Laporan Pencatat</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="disabledTextinput" name="tiket"
                  value="{{ $laporan->tiket }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tgl Mencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control"  id="tanggalmencatat" name="tanggalmencatat"
                   value="{{ $laporan->tanggalmencatat }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nip Pencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nippencatat" name="nippencatat" value="{{ $laporan->nippencatat }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapencatat" name="namapencatat" value="{{ $laporan->namapencatat }}"readonly/>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">Pelapor</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapelapor" name="namapelapor" value="{{ $laporan->namapelapor }}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namabidang" name="namabidang" value="{{ $laporan->namabidang }}" readonly />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Hp</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nomorhp" name="nomorhp" value="{{ $laporan->nomorhp }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Permasalahan</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="permasalahan" name="permasalahan" rows="4"readonly>{{ $laporan->permasalahan }}</textarea>
                </div>
              </div>
            </div>
          </div>
          @if($size != 0)
          <div class="row">
           <div class="col-md-6" style="margin-top:-20px;">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gambar</label>
                <div class="col-sm-9">
                  @if($lastImage != null)
                  <a href="{{ asset($lastImage->image)}}" target="_blank" rel="noopener noreferrer"><embed src="{{ asset($lastImage->image)}}" style="max-height:300px; max-width:440px;"></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Solusi Masalah</label>
                <div class="col-sm-10">
                  <table class="table table-responsive table-hover table-bordered">
                    <thead class="bg-gray disabled color-palette">
                      <tr>
                        <td style="text-align: center; font-weight: bold; width:25%">Eksekutor</td>
                        <td style="text-align: center; font-weight: bold; width:40%">Solusi</td>
                        <td style="text-align: center; font-weight: bold; width:25%">Pada</td>
                        <td style="text-align: center; font-weight: bold; width:10%">Dokumentasi</td>
                      </tr>
                    </thead>
                    @for($i = 0; $i < $size; $i++)
                    <tbody>
                      <tr>
                        <td>{{ $users[$i]->nama }}</td>
                        <td>{{ $solusis[$i]->solusi }}</td>
                        <td>{{ $solusis[$i]->created_at }}</td>
                        <td><a href="/{{ $images[$i]->image }}" target="blank">Dokumentasi</a></td>
                      </tr>
                    </tbody>
                    @endfor
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="box">
            <div class="box-header with-border">
                <a href="{{url('/laporan') }}" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection