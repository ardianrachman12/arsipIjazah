<?php

namespace App\Http\Controllers;

use App\Models\Ijazah;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $student = Student::count();
        $ijazah = Ijazah::count();

        return view('page.admin.dashboard', [
            'user' => $user,
            'student' => $student,
            'ijazah' => $ijazah
        ]);
    }
}
