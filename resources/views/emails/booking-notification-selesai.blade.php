<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Booking</title>
</head>
<body>
    <h2>Permohonan Booking</h2>
    <p>
        Yth. {{$booking->namaPemohon}} , permohonan booking anda telah selesai diproses dengan rincian sebagai berikut : <br> <br>
        Nomor Tiket: {{ $booking->tiket }} <br>
        Nama Pemohon: {{ $booking->namaPemohon }} <br>
        Nama Aset: {{ $booking->aset->merk }} {{ $booking->aset->nama }} ({{ $booking->aset->kodeUnit }}) <br>
        Periode Permohonan: {{ $mulai}} WIB s.d. {{ $selesai}} WIB <br><br>
        Detail: <a href="http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}">http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}</a>
    </p>
</body>
</html>
