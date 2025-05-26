<?php

namespace App\Exports;

use App\Models\Ijazah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IjazahExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Ijazah::with(['student.programstudi'])->get()->map(function ($item) {
            return [
                'Nama' => $item->student->nama_lengkap,
                'NISN' => $item->student->nisn,
                'Nomor Ijazah' => $item->nomor_ijazah,
                'Nomor Seri' => $item->nomor_seri,
                'Program Studi' => $item->student->programstudi->name,
                'Tahun Lulus' => $item->tahun_lulus,
                'Nilai Rata-Rata' => $item->nilai_rata_rata,
                'Status Verifikasi' => $item->status_verifikasi ? 'Sudah' : 'Belum',
                'Tanggal Terbit' => $item->tanggal_terbit->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NISN',
            'Nomor Ijazah',
            'Nomor Seri',
            'Program Studi',
            'Tahun Lulus',
            'Nilai Rata-Rata',
            'Status Verifikasi',
            'Tanggal Terbit',
        ];
    }
}
