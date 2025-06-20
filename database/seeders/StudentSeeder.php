<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                'nisn' => '1234567890',
                'nis' => '20210001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2005-03-15',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'nama_orang_tua' => 'Budi Santoso',
                'no_telepon' => '081234567890',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '2345678901',
                'nis' => '20210002',
                'nama_lengkap' => 'Budi Setiawan',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2005-05-20',
                'alamat' => 'Jl. Pahlawan No. 5, Bandung',
                'nama_orang_tua' => 'Joko Widodo',
                'no_telepon' => '082345678901',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '3456789012',
                'nis' => '20210003',
                'nama_lengkap' => 'Citra Dewi',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2005-07-10',
                'alamat' => 'Jl. Diponegoro No. 15, Surabaya',
                'nama_orang_tua' => 'Siti Aminah',
                'no_telepon' => '083456789012',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '4567890123',
                'nis' => '20210004',
                'nama_lengkap' => 'Dian Pratama',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2005-01-25',
                'alamat' => 'Jl. Malioboro No. 20, Yogyakarta',
                'nama_orang_tua' => 'Agus Suparman',
                'no_telepon' => '084567890123',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '5678901234',
                'nis' => '20210005',
                'nama_lengkap' => 'Eka Putri',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2005-09-05',
                'alamat' => 'Jl. Gatot Subroto No. 8, Medan',
                'nama_orang_tua' => 'Rina Melati',
                'no_telepon' => '085678901234',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '6789012345',
                'nis' => '20210006',
                'nama_lengkap' => 'Fajar Nugraha',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2005-11-12',
                'alamat' => 'Jl. Pemuda No. 30, Semarang',
                'nama_orang_tua' => 'Herman Susilo',
                'no_telepon' => '086789012345',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '7890123456',
                'nis' => '20210007',
                'nama_lengkap' => 'Gita Sari',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '2005-04-18',
                'alamat' => 'Jl. Raya Kuta No. 12, Denpasar',
                'nama_orang_tua' => 'Wayan Budi',
                'no_telepon' => '087890123456',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '8901234567',
                'nis' => '20210008',
                'nama_lengkap' => 'Hadi Pranoto',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '2005-08-22',
                'alamat' => 'Jl. Sultan Hasanuddin No. 7, Makassar',
                'nama_orang_tua' => 'Andi Malik',
                'no_telepon' => '088901234567',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '9012345678',
                'nis' => '20210009',
                'nama_lengkap' => 'Indah Permata',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => '2005-02-28',
                'alamat' => 'Jl. Jenderal Sudirman No. 45, Palembang',
                'nama_orang_tua' => 'Dewi Lestari',
                'no_telepon' => '089012345678',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
            [
                'nisn' => '0123456789',
                'nis' => '20210010',
                'nama_lengkap' => 'Joko Susilo',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2005-06-08',
                'alamat' => 'Jl. Ijen No. 25, Malang',
                'nama_orang_tua' => 'Sutrisno',
                'no_telepon' => '080123456789',
                'angkatan' => 2021,
                'program_studi_id' => 1,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
