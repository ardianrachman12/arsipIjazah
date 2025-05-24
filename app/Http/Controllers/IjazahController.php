<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Student;
use Illuminate\Http\Request;

class IjazahController extends Controller
{
    public function index(){
        $ijazahs = Ijazah::with(['student', 'student.programstudi'])->get();
        $students = Student::all();
        // dd($ijazahs);
        return view('page.admin.ijazah', [
            'ijazahs' => $ijazahs,
            'students' => $students
        ]);
    }
}
