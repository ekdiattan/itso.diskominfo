<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Booking</title>
</head>
<body>
    <h2>Permohonan Booking</h2>
    <p>
        Yth. {{$booking->namaPemohon}} , permohonan booking anda telah berhasil dan akan diproses dengan rincian sebagai berikut : <br> <br>
        Nomor Tiket: {{ $booking->tiket }} <br>
        Pemohon: {{ $booking->namaPemohon }} <br>
        Nama Aset: {{ $booking->aset->merk }} {{ $booking->aset->nama }} ({{ $booking->aset->kodeUnit }}) <br>
        Periode Pinjam: {{ $mulai->format('G:i, d M Y') }} WIB s.d. {{ $selesai->format('H:i, d M Y') }} WIB <br>
        IP:{{ $_SERVER['REMOTE_ADDR'] }}<br>
        Hostname:{{ gethostbyaddr($_SERVER['REMOTE_ADDR']) }}<br>
        Perangkat: {{ request()->server('HTTP_USER_AGENT') }} <br>
        Detail: <a href="http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}">http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}</a>
    </p>
</body>
</html>
