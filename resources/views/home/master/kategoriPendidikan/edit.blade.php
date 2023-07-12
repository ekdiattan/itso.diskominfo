@extends('home.partials.main')
@section('container')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <form action="/katpen/update/{{ $edit->id }}" method="post">
        @csrf
        <p class="card-description">Edit Kategori Pendidikan</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kategori</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kategori" name="kategori"  value="{{ $edit->kategori }}" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Jurusan</label>
              <div class="col-sm-5">
                <select class="form-control selectpicker" aria-label="Default select example"  data-live-search="true" id="jurusan" name="jurusan" required>
                   <option value="{{$edit->jurusan}}">{{$edit->jurusan}}</option>
                   <option value="">--PILIH--</option>
                    @foreach($data as $data)
                    <option value="{{$data->majors}}">{{$data->majors}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $edit->keterangan }}" />
              </div>
            </div>
          </div>
        </div>
        
          <div class="box">
            <div class="box-header with-border">
              <a href="/kategori-pendidikan" class="btn btn-danger mr-2 btn-flat"><i class="fa fa-file-excel-o"></i> Kembali</a>
              <button type="submit" class="btn btn-primary mr-2 btn-flat">Submit</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection