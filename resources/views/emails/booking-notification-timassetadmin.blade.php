<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Peminjaman</title>
</head>
<body>
    <h2>Permohonan Peminjaman Tim Aset</h2>
    <p>
        Permohonan peminjaman telah masuk dan sudah disetujui dengan rincian sebagai berikut : <br> <br>
        Nomor Tiket: {{ $booking->tiket }} <br>
        Nama Penyetuju: {{ auth()->user()->nama }} <br>
        Pemohon: {{ $booking->namaPemohon }} <br>
        Nama Aset: {{ $booking->aset->merk }} {{ $booking->aset->nama }} ({{ $booking->aset->kodeUnit }}) <br>
        Periode Pinjam: {{ $mulai->format('G:i, d M Y') }} WIB s.d. {{ $selesai->format('H:i, d M Y') }} WIB <br><br>
        Detail: <a href="http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}">http://itso.diskominfo.jabarprov.go.id/tracking/{{ $booking->tiket }}</a>
    </p>
</body>
</html>
