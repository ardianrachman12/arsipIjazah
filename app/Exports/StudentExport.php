<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil data dengan relasi program studi (jika ada)
        return Student::with('programstudi')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Program Studi',
            'NISN',
            'NIS',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Nama Orang Tua',
            'No Telepon',
            'Foto',
            'Angkatan',
            'Tanggal Dibuat',
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            optional($student->programstudi)->name ?? '-', // pastikan ada relasi programstudi
            $student->nisn,
            $student->nis,
            $student->nama_lengkap,
            $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $student->tempat_lahir,
            $student->tanggal_lahir->format('Y-m-d'),
            $student->alamat,
            $student->nama_orang_tua,
            $student->no_telepon,
            $student->foto,
            $student->angkatan,
            $student->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
