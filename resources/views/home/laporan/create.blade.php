@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">
@section('container')
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form action="/laporan/create" method="post" enctype="multipart/form-data">
          @csrf
          <p class="card-description">Laporan Pencatat</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tgl Mencatat</label>
                <div class="col-sm-9 overflow-auto">
                  <input type="text" class="form-control"  id="tanggalmencatat" name="tanggalmencatat" value="{{ $tglLaporan }}" readonly>
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
                  <input type="text" class="form-control" id="namapelapor" maxlength="255" name="namapelapor" list="pegawai" autocomplete="off" onChange="setBidang()" required/>
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
                <label class="col-sm-3 col-form-label">Nama Bidang</label>
                <div class="col-sm-9">
                  <select class="form-control" id="namabidang" name="namabidang" required>
                    <option value="">Pilih Bidang</option>
                    @foreach ($bidang as $bidang)
                    <option value="{{ $bidang->namabidang }}">{{ $bidang->namabidang }}</option>
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
                  <input type="text" class="form-control" id="nomorhp" name="nomorhp" maxlength="255" required/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Pemasalahan</label>
                <div class="col-sm-9">
                <textarea id="textbox" class="form-control" maxlength="255" name="permasalahan" rows="5"></textarea>
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
          <a class="btn btn-danger" href="/laporan" role="button">Kembali</a>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function setBidang(){
      const name = document.getElementById('namapelapor').value;
      let pegawais = @json($pegawais);
      for(let i = 0; i < pegawais.length; i++){
        console.log(pegawais[i]);
        if(pegawais[i].nama == name){
          $("#namabidang").val(pegawais[i].unitKerja); // masih harus disesuaikan
        }
      }
    }
  </script>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
@endpush