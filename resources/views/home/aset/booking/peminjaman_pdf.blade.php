<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<center>
		<h4>SURAT PERMOHONAN PEMINJAMAN BARANG ASET</h4> 
        <h5>NOMOR : </h5>
        <br>
	<table class='table table-bordered'>
        <thead>
            <tr>
                <th style="font-size:13px;">Tiket</th>
                <th style="font-size:13px;">Nama Pemohon</th>
                <th style="font-size:13px;">No Telepon</th>
                <th style="font-size:13px;">Bidang</th>
                <th style="font-size:13px;">Nama Aset</th>
                <th style="font-size:13px;">Mulai</th>
                <th style="font-size:13px;">Selsai</th>
                <th style="font-size:13px;">Keperluan</th>
                <th style="font-size:13px;">Perihal</th>
                <th style="font-size:13px;">Tanggal Permohonan</th>
                <th style="font-size:13px;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:13px;">{{ $datas->tiket }}</td>
                <td style="font-size:13px;">{{ $datas->namaPemohon }}</td>
                <td style="font-size:13px;">{{ $datas->noTelp }}</td>
                <td style="font-size:13px;">{{ $datas->bidang }}</td>
                <td style="font-size:13px;">{{ $aset->merk }} {{ $aset->nama }}</td>
                <td style="font-size:13px;">{{ $datas->mulai }}</td>
                <td style="font-size:13px;">{{ $datas->selesai }}</td>
                <td style="font-size:13px;">{{ $datas->keperluan }}</td>
                <td style="font-size:13px;">{{ $datas->perihal }}</td>
                <td style="font-size:13px;">{{ $datas->tanggalPermohonan}}</td>
                <td style="font-size:13px;">{{ $datas->status}}</td>
            </tr>
        </tbody>
	</table>

    <br><br>
    <table class='table table-borderles' cellspacing="2" cellpadding="2">
            <tr>
                <td class="text-center" style="border-width: 0px">Mengetahui</td>
                <td class="text-center" style="border-width: 0px">Menyetujui</td>
                <td class="text-center" style="border-width: 0px">Pemohon</td>
            </tr>   
            <tr>
                <td class="text-center pt-0" style="border-width: 0px;">Pengelola barang</td>
                <td class="text-center pt-0" style="border-width: 0px;">Kepala Sub Bagian Tata Usaha</td>
            </tr>
            <br><br>
            <tr>
                <td class="text-center" style="border-width: 0px;"><h1><hr></h1></td>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center" style="border-width: 0px;"><h1><hr></h1></td>
            </tr>
            <tr>
                <td class="text-center pt-0" style="border-width: 0px;"></td>
                <td class="text-center pt-0" style="border-width: 0px;"><b>Hj. ASTRIA PRIANTIE, SE., MM</b></td>
                <td class="text-center pt-0" style="border-width: 0px;">{{$datas->namaPemohon}}</td>
            </tr>
            <tr>
                <td class="text-left pt-0" style="border-width: 0px;">NIP : </td>
                <td class="text-center pt-0" style="border-width: 0px;">Penata</td>
                <td class="text-center pt-0" style="border-width: 0px;">NIP : {{$datas->nip}}</td>
            </tr>
            <tr>
                <td class="text-center" style="border-width: 0px;"></td>
                <td class="text-center pt-0" style="border-width: 0px;">NIP : 197111272007012005</td>
                <td class="text-center" style="border-width: 0px;"></td>
            </tr>
	</table>

</body>
</html>
