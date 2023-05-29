<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div id="link" onclick="copy()">
                <div class="box-body">
                    <section class=" table-responsive ">
                <p>Assalamualaikum Warohmatullahi Wabarokatuh Bapak/Ibu.. <br>
                    Semangat pagi 😁<br> 
                    Disampaikan daftar pegawai yang belum mengisi daftar presensi untuk skema masuk kerja sampai pukul <strong> 
			@foreach($last_update as $time){{\Carbon\Carbon::parse( $time->update)->format('H:i:s') }} @endforeach  WIB </strong> berikut :</p>

                    <p> @foreach($absen_masuk as $item)
                        {{$item->nama}} <br>
                        @endforeach
                    </p>

                    <p>Terima kasih 🙏😊<br>
                        Salam, <br>
                        Tim Sekretariat Diskominfo <br>
                        #ExcellentService <br>
                        #DiskominfoJuara <br>
                        #JabarJuaraLahirBatin</p>

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
                </section>
            </div>
        </div>
    </div>
</div>

