@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Laporan</h4>
        <form method="post" action="/laporan-edit/{{ $laporan->id }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tiket</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="tiket" name="tiket"
                  value="@if(old('tiket')){{old('tiket')}}@else{{$laporan->tiket}}@endif" readonly/>
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
                  <input type="text" class="form-control" id="nippencatat" name="nippencatat" value="{{ $laporan->nippencatat }}"readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pencatat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapencatat" name="namapencatat" value="{{ $laporan->namapencatat }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="namapelapor" name="namapelapor" list="pegawai" maxlength="255" autocomplete="off" value="{{ $laporan->namapelapor }}" required/>
                  <datalist id="pegawai">
                    @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->nama }}">
                    @endforeach
                  </datalist>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Unit Kerja</label>
                <div class="col-sm-9">
                  <select class="form-control" id="unitkerja" name="unitkerja" maxlength="255">
                    @foreach ($unitkerjas as $unitkerja)
                    <option value="{{ $unitkerja->namaUnit }}" @if($laporan->namabidang == $unitkerja->namaUnit) selected @endif>{{ $unitkerja->namaUnit }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Hp</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nomorhp" name="nomorhp" maxlength="255" value="{{ $laporan->nomorhp }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Keterangan Masalah</label>
                <div class="col-sm-9">
                  <textarea id="textbox" class="form-control" maxlength="255" name="permasalahan" rows="5">{{ $laporan->permasalahan }}</textarea>
                    <span id="char_count"></span>
<script>
let textArea = document.getElementById("textbox");
let characterCounter = document.getElementById("char_count");
const maxNumOfChars = 255;

const countCharacters = () => {
    let numOfEnteredChars = textArea.value.length;
    let counter = maxNumOfChars - numOfEnteredChars;
    characterCounter.textContent = counter + "/255 Karakter";
    if (counter <= 0) {
    characterCounter.textContent = "Tidak bisa lebih dari 255 karakter";
    characterCounter.style.color = "red";
    } else if (counter < 75) {
    characterCounter.style.color = "red";
    } else if (counter < 150) {
    characterCounter.style.color = "orange";
    }else {
    characterCounter.style.color = "black";
    }
};
textArea.addEventListener("input", countCharacters);
</script>
                </div>
              </div>
            </div>
          </div>      
          <div class="card-body">
            <a href="{{url('/laporan') }}" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Kembali</a>
            <button type="submit" class="btn btn-primary" style="margin-left:10px;">Submit</button>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection