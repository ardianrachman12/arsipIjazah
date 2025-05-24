<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programStudis = [
            [
                'name' => 'Ilmu Pengetahuan Alam (IPA)',
                'kode_program_studi' => 'IPA',
                'deskripsi' => 'Program studi yang fokus pada pembelajaran ilmu alam seperti Matematika, Fisika, Kimia, dan Biologi.',
            ],
            [
                'name' => 'Ilmu Pengetahuan Sosial (IPS)',
                'kode_program_studi' => 'IPS',
                'deskripsi' => 'Program studi yang mempelajari berbagai aspek sosial kemasyarakatan seperti Ekonomi, Geografi, Sosiologi, dan Sejarah.',
            ],
            [
                'name' => 'Bahasa dan Budaya',
                'kode_program_studi' => 'BAHASA',
                'deskripsi' => 'Program studi yang berfokus pada pembelajaran bahasa asing, sastra, dan kebudayaan.',
            ],
        ];

        foreach ($programStudis as $prodi) {
            DB::table('program_studis')->insert([
                'name' => $prodi['name'],
                'kode_program_studi' => $prodi['kode_program_studi'],
                'deskripsi' => $prodi['deskripsi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
