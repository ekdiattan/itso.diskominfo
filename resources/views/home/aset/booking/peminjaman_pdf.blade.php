<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <!-- <style>
    table, th, td {
        border: 1px solid black;
    }
</style> -->
	<center>
		<h4>SURAT PERMOHONAN PEMINJAMAN BARANG ASET</h4> 
        <h5>NOMOR : </h5>
        <br>
	<table class='table table-bordered border-black'>
        <thead>
            <tr>
                <th style="font-size:12px; border: 1px solid black;">Tiket</th>
                <th style="font-size:12px; border: 1px solid black;">Nama Pemohon</th>
                <th style="font-size:12px;border: 1px solid black;">No Telepon</th>
                <th style="font-size:12px;border: 1px solid black;">Bidang</th>
                <th style="font-size:12px;border: 1px solid black;">Nama Aset</th>
                <th style="font-size:12px;border: 1px solid black;">Mulai</th>
                <th style="font-size:12px;border: 1px solid black;">Selsai</th>
                <th style="font-size:12px;border: 1px solid black;">Keperluan</th>
                <th style="font-size:12px;border: 1px solid black;">Perihal</th>
                <th style="font-size:12px;border: 1px solid black;">Tanggal Permohonan</th>
                <th style="font-size:12px;border: 1px solid black;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->tiket }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->namaPemohon }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->noTelp }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->getBidang->aliasUnit }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $aset->merk }} {{ $aset->nama }}</td>
                <td style="font-size:12px;border: 1px solid black;"><p>{{ $mjam }}<br>{{ $mdate }}</p></td>
                <td style="font-size:12px;border: 1px solid black;"><p>{{ $sjam }}<br>{{ $sdate }}</p></td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->keperluan }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->perihal }}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->tanggalPermohonan}}</td>
                <td style="font-size:12px;border: 1px solid black;">{{ $datas->status}}</td>
            </tr>
        </tbody>
	</table>

    <br><br>
    <table class='table table-sm table-borderles' cellspacing="2" cellpadding="2">
            <tr>
                <td class="text-center" style="border-width: 0px">Mengetahui</td>
                <td class="text-center" style="border-width: 0px">Menyetujui</td>
            </tr>   
            <tr>
                <td class="text-center pt-0" style="border-width: 0px;">Pengelola barang</td>
                <td class="text-center pt-0" style="border-width: 0px;">Kepala Sub Bagian Tata Usaha</td>
                <td class="text-center" style="border-width: 0px">Pemohon</td>
            </tr>
            <br><br>
            <tr>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center" style="border-width: 0px;"></td>
            </tr>
            <tr>
                <td class="text-center" style="border-width: 0px;"><h1><hr style="border-color: #000000;"></h1></td>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center" style="border-width: 0px;"><h1><hr style="border-color: #000000;"></h1></td>
            </tr>
            <tr>
                <td class="text-center pt-0" style="border-width: 0px;">{{ $datas->penyetuju }}</td>
                <td class="text-center pt-0" style="border-width: 0px;"><b>Hj. ASTRIA PRIANTIE, SE., MM</b></td>
                <td class="text-center pt-0" style="border-width: 0px;">{{ $datas->namaPemohon }}</td>
            </tr>
            <tr>
                <td class="text-center pt-0" style="border-width: 0px;">NIP : {{ $datas->nipPenyetuju }}</td>
                <td class="text-center pt-0" style="border-width: 0px;">Penata</td>
                <td class="text-center pt-0" style="border-width: 0px;">NIP : {{ $datas->nip }}</td>
            </tr>
            <tr>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center pt-0" style="border-width: 0px;">NIP : 197111272007012005</td>
                <td class="text-center" style="border-width: 0px;"></td>
            </tr>
	</table>

</body>
</html>
