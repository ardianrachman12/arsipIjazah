<?php

namespace Database\Seeders;

use App\Models\Ijazah;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IjazahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        $diplomas = [
            [
                'nomor_ijazah' => 'DN-2021-0001',
                'nomor_seri' => 'S12345678',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '85.50',
                'tanggal_terbit' => '2021-06-15',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0002',
                'nomor_seri' => 'S23456789',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '82.75',
                'tanggal_terbit' => '2021-06-16',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0003',
                'nomor_seri' => 'S34567890',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '88.25',
                'tanggal_terbit' => '2021-06-17',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0004',
                'nomor_seri' => 'S45678901',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '79.50',
                'tanggal_terbit' => '2021-06-18',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0005',
                'nomor_seri' => 'S56789012',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '91.00',
                'tanggal_terbit' => '2021-06-19',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0006',
                'nomor_seri' => 'S67890123',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '84.75',
                'tanggal_terbit' => '2021-06-20',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0007',
                'nomor_seri' => 'S78901234',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '87.25',
                'tanggal_terbit' => '2021-06-21',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0008',
                'nomor_seri' => 'S89012345',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '83.00',
                'tanggal_terbit' => '2021-06-22',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0408',
                'nomor_seri' => 'S89015345',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '83.00',
                'tanggal_terbit' => '2021-06-22',
                'status_verifikasi' => true,
            ],
            [
                'nomor_ijazah' => 'DN-2021-0608',
                'nomor_seri' => 'S89412345',
                'tahun_lulus' => 2021,
                'nilai_rata_rata' => '83.00',
                'tanggal_terbit' => '2021-06-22',
                'status_verifikasi' => true,
            ],
        ];

        foreach ($students as $index => $student) {
            Ijazah::create(array_merge($diplomas[$index], ['student_id' => $student->id]));
        }
    }
}
