<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Models\ProgramStudi;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $prodi = ProgramStudi::all();
        $students = Student::latest()->get();
        return view('page.admin.student', [
            'students' => $students,
            'prodi' => $prodi
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|unique:students,nisn|max:15|min:12',
            'nis' => 'nullable|unique:students,nis|max:15|min:12',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nama_orang_tua' => 'required',
            'no_telepon' => ['required', 'max:15', 'min:8', 'regex:/^(08|628)\d+$/'],
            'foto' => 'required|image|max:2048',
            'angkatan' => 'required|integer|max:' . date('Y'),
            'program_studi_id' => 'required|exists:program_studis,id',
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = 'uploads/' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('uploads'), $validated['foto']);
        }

        Student::create($validated);

        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'nisn' => 'required|max:15|min:12|unique:students,nisn,' . $student->id . 'id',
            'nis' => 'required|max:15|min:12|unique:students,nis,' . $student->id . 'id',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nama_orang_tua' => 'required',
            'no_telepon' => ['required', 'max:15', 'min:8', 'regex:/^(08|628)\d+$/'],
            'foto' => 'nullable|image|max:2048',
            'angkatan' => 'required|integer|max:' . date('Y'),
            'program_studi_id' => 'required|exists:program_studis,id',
        ], [
            'no_telepon.regex' => 'Nomor telepon harus diawali dengan 08 atau 628 dan diikuti angka.',
        ]);

        if ($request->hasFile('foto')) {
            if ($student->foto && File::exists(public_path($student->foto))) {
                unlink(public_path($student->foto));
            }
            $validated['foto'] = 'uploads/' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('uploads'), $validated['foto']);
        }

        $student->update($validated);

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->foto && File::exists(public_path($student->foto))) {
            unlink(public_path($student->foto));
        }

        $student->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus!');
    }

    public function exportExcel()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }
}
