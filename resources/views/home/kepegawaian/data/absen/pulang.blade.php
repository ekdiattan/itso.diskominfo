@extends('home.partials.main')
<link rel="icon" href="{{ asset('assets/images/jabar.png') }}">

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('container')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                {{ session('success') }}
                </div>
                @endif
                <div class="box-header with-border">
                    <a href="store-pulang" class="btn btn-primary">Update Data</a>
                    <a onclick="copy()" class="btn btn-warning"><i class="fa fa-copy"></i> Copy Text</a>
                    <a class="btn btn-success" href="https://wa.me/?text={{ $strAbsen }}"><i class="fa fa-copy"></i> Send To WhatsApp</a>
                    <a href="/pulang-export" class="btn btn-danger">Export to PDF</a>
                </div>
                <br>
                @if(!empty($absen_pulang))
                <div id="link" onclick="copy()">
                    <div class="box-body">
                        <section class=" table-responsive ">
                            <div>
                                <p>Assalammualaikum Warahmatullahi Wabarokatuh.. <br>
                                    Selamat sore Bapak/Ibu <br>
                                    <br>
                                    Disampaikan daftar pegawai yang belum melakukan presensi untuk skema pulang kerja
                                    sampai dengan pukul <strong>
                                        @foreach ($last_update as $item)
                                            {{ \Carbon\Carbon::parse($item->update)->format('H:i:s') }}
                                        @endforeach WIB
                                    </strong> sebagai berikut :
                                </p>
                                <p>
                                    @foreach ($absen_pulang as $item)
                                        {{ $item->nama }}
                                        <br>
                                    @endforeach
                                </p>
                                <br>
                                <p>Salam, <br>
                                    Tim Sekretariat Diskominfo <br>
                                    #ExcellentService <br>
                                    #DiskominfoJuara <br>
                                    #JabarJuaraLahirBatin
                                </p>
                                <script>
                                    function copy() {
                                        var copyText = document.getElementById("link").innerText;
                                        var elem = document.createElement("textarea");
                                        document.body.appendChild(elem);
                                        elem.value = copyText;
                                        elem.select();
                                        document.execCommand("copy");
                                        document.body.removeChild(elem);
                                    }
                                </script>
                            </div>
                        </section>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endsection