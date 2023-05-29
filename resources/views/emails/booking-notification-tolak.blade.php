<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Booking</title>
</head>
<body>
    <h2>Permohonan Booking</h2>
    <p>
        Yth. {{$booking->namaPemohon}} , mohon maaf permohonan booking anda telah <b>ditolak</b> dengan rincian sebagai berikut : <br> <br>
        Nomor Tiket: {{ $booking->tiket }} <br>
        Pemohon: {{ $booking->namaPemohon }} <br>
        Nama Aset: {{ $booking->aset->merk }} {{ $booking->aset->nama }} ({{ $booking->aset->kodeUnit }}) <br>
        Periode Pinjam: {{ $mulai}} WIB s.d. {{ $selesai}} WIB <br>
        Dengan Alasan: {{ $booking->alasan }} <br>
        <!-- s -->
        Detail: <a href="http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}">http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}</a>
    </p>
</body>

<script>
        var hostname = window.location.hostname;
        document.getElementById("hostname").innerText = hostname;
    </script>
<script>
        // Mendapatkan alamat IP pengguna melalui API pihak ketiga
        fetch('https://api.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                // Menampilkan alamat IP pada elemen dengan id "ip"
                document.getElementById("ip").innerText = data.ip;
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    </script>
</html>
