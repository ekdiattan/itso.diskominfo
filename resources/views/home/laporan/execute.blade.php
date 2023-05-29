@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Laporan</h4>
        <form method="post" action="/laporan-execute/{{ $laporan->id }}" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" id="namapelapor" name="namapelapor" value="{{ $laporan->namapelapor }}" readonly/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="namabidang" name="namabidang" value="{{ $laporan->namabidang }}" readonly/>
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
                <label class="col-sm-3 col-form-label">Keterangan Masalah</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="permasalahan" name="permasalahan" rows="4" readonly>{{ $laporan->permasalahan }}</textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row" style="margin-top:-30px;">
              <label class="col-sm-3 col-form-label">Upload foto</label>
              <div class="col-sm-9">
                  @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      @foreach($errors->all() as $error)
                      {{ $error }}
                      @endforeach
                    </div>
                  @else
                  <span class="badge badge-primary">Tambah Dokumentasi Baru</span>
                  @endif
                  <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg, image/bmp, .pdf" required>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">Eksekutor</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                    <select class="form-control" id="kategori" name="kategori" >
                      @foreach ($kategori as $kategori)
                      <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Service</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status" name="status">
                        <option value="Self Service" >Self Service</option>
                        <option value="Vendor">Vendor</option>
                    </select>
                    
                    {{-- script other value --}}
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script type="text/javascript">
                                var otherInput;
                                var mulaiservice, selesaiservice;
                                var serviceTypeInput = $('#status');
                                serviceTypeInput.on('change', function() {
                                    otherInput = $('#namavendor');
                                    mulaiservice = $('#mulaiservice');
                                    selesaiservice = $('#selesaiservice');
                                    if (serviceTypeInput.val() == "Vendor") {
                                        otherInput.show();
                                        mulaiservice.show();
                                        selesaiservice.show();
                                    } else {
                                        otherInput.hide();
                                        mulaiservice.hide();
                                        selesaiservice.hide();
                                    }
                                });
                    </script>
                </div>
                {{-- other field --}}
                <div class="col-sm-5 mb-3">
                  <br>
                    <input class="form-control form-control-user" name='namavendor' id='namavendor'
                        type="text" placeholder="Nama Vendor" style="display: none" value="{{ $laporan->namavendor }}" >
                </div>
                <div class="col-sm-3">
                  <br>
                    {{-- tanggal --}}
                    <input type="date" class="form-control" id="mulaiservice" name="mulaiservice"
                        placeholder="mulaiservice" style="display: none" value="{{ $laporan->mulaiservice }}">
                </div>
                <div class="col-sm-3">
                  <br>
                  <input type="date" class="form-control" id="selesaiservice" name="selesaiservice"
                        placeholder="selesaiservice" style="display: none" value="{{ $laporan->selesaiservice }}">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Eksekusi</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="tanggalEksekusi" name="tanggalEksekusi" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Solusi Masalah</label>
                <div class="col-sm-9">
                    <textarea id="textbox" class="form-control" maxlength="255" name="solusi" rows="5"></textarea>
                    <span id="char_count"></span>
                </div>
              </div>
            </div>
          </div>
          <!-- only show when checkboc checked -->
          <div class="row">
            <div class="col-sm-6">
              <label class="col-sm-3 col-form-label">Sudah Selesai?</label>
              <input type="radio" name="isDone" id="true" value="true" onClick="showDoneDate()">
              <label>Ya</label>
              <input type="radio" name="isDone" id="false" value="false" onClick="showDoneDate()">
              <label>Belum</label>
            </div>
          </div>
          <div id="doneForm" class="row" hidden>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="tanggalselesai" name="tanggalselesai"/>
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

  function showDoneDate(){
    const form = document.getElementById('doneForm');
    if(document.getElementById("true").checked){
      // show form tanggal selesai
      form.removeAttribute('hidden');
      document.getElementById('tanggalselesai').setAttribute('required', '');
    } else if (document.getElementById("false").checked){
      // hide form tanggal selesai
      form.setAttribute('hidden', '');
      document.getElementById('tanggalselesai').removeAttribute('required');
    }
  }
</script>

