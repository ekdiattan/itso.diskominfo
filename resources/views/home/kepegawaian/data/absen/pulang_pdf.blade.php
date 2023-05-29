    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div id="link" onclick="copy()">
                    <div class="box-body">
                        <section class=" table-responsive ">
                            <div>
                                <p>Assalammualaikum Warahmatullahi Wabarokatuh.. <br>
                                    Selamat sore Bapak/Ibu <br>
                                    <br>
                                    Disampaikan daftar pegawai yang belum mengisi daftar presensi untuk skema pulang kerja
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
            </div>
        </div>