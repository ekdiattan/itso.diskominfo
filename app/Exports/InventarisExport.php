<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarisExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    public function query()
    {
        return Inventaris::query();
    }

    public function map($inventaris): array
    {
        return[
            $inventaris-> merk,
            $inventaris-> tipe,
            $inventaris-> namaBarang,
            $inventaris-> image,
            $inventaris-> kondisiBarang,
            $inventaris-> noSertifikat,
            $inventaris-> lokasi,
            $inventaris-> caraPerolehan,
            $inventaris-> bulanPerolehan,
            $inventaris-> tahunPerolehan,
            $inventaris-> kuantitas,
            $inventaris-> satuan,
            $inventaris-> hargaSatuan,
            $inventaris-> nilaiPerolehan,
            $inventaris-> umurEkonomis,
            $inventaris-> keterangan,
            $inventaris-> status,
            $inventaris-> pengguna,
            $inventaris-> noHp,
            $inventaris-> noBeritaAcara
        ];
    }

    public function headings(): array
    {
        return[
            'Merk',
            'Tipe',
            'Nama Barang',
            'Image',
            'Kondisi Barang',
            'No Sertifikat',
            'Lokasi',
            'Cara Perolehan',
            'Bulan Perolehan',
            'Tahun Perolehan',
            'Satuan',
            'Harga Satuan',
            'Nilai Perolehan',
            'Umur Ekonomis',
            'Status',
            'Pengguna',
            'No Hp',
            'No Berita Acara'
        ];
    }
}
