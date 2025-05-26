<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\ProgramStudi;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $student = Student::count();
        $ijazah = Ijazah::count();
        $prodi = ProgramStudi::count();

        // chart ijazah per tahun
        $data = DB::table('ijazahs')
            ->select('tahun_lulus', DB::raw('count(*) as total'))
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'asc')
            ->get();

        $tahun = $data->pluck('tahun_lulus');
        $jumlah = $data->pluck('total');

        // chart siswa per jurusan
        $data = DB::table('students')
            ->join('program_studis', 'students.program_studi_id', '=', 'program_studis.id')
            ->select('program_studis.name as jurusan', DB::raw('count(students.id) as total'))
            ->groupBy('program_studis.name')
            ->orderBy('program_studis.name')
            ->get();

        $jurusan = $data->pluck('jurusan');
        $jumlahJurusan = $data->pluck('total');

        return view('page.admin.dashboard', [
            'user' => $user,
            'student' => $student,
            'ijazah' => $ijazah,
            'prodi' => $prodi,
            'tahun' => $tahun,
            'jumlah' => $jumlah,
            'jurusan' => $jurusan,
            'jumlahJurusan' => $jumlahJurusan,
        ]);
    }
}
