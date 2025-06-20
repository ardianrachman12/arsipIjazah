<?php

namespace App\Http\Controllers;

use App\Exports\IjazahExport;
use App\Models\Ijazah;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class IjazahController extends Controller
{
    public function index()
    {
        $ijazahs = Ijazah::with(['student', 'student.programstudi'])->get();
        $students = Student::all();
        // dd($ijazahs);
        return view('page.admin.ijazah', [
            'ijazahs' => $ijazahs,
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'nomor_ijazah' => 'required|max:255|min:12',
            'nomor_seri' => 'required|max:255|min:12',
            'tahun_lulus' => 'required|integer',
            'nilai_rata_rata' => 'required|string|max:10',
            'file_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status_verifikasi' => 'required|boolean',
            'tanggal_terbit' => 'required|date',
        ]);

        $ijazah = new Ijazah($request->except('file_ijazah'));

        if ($request->hasFile('file_ijazah')) {
            $file = $request->file('file_ijazah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/file');
            $file->move($destination, $filename);
            $ijazah->file_ijazah = 'uploads/file/' . $filename;
        }

        $ijazah->save();

        return redirect()->back()->with('success', 'Ijazah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'nomor_ijazah' => 'required|max:255|min:12',
            'nomor_seri' => 'required|max:255|min:12',
            'tahun_lulus' => 'required|integer',
            'nilai_rata_rata' => 'required|string|max:10',
            'file_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'status_verifikasi' => 'required|boolean',
            'tanggal_terbit' => 'required|date',
        ]);

        $ijazah = Ijazah::findOrFail($id);
        $ijazah->fill($request->except('file_ijazah'));

        if ($request->hasFile('file_ijazah')) {
            // Hapus file lama jika ada
            if ($ijazah->file_ijazah && File::exists(public_path($ijazah->file_ijazah))) {
                File::delete(public_path($ijazah->file_ijazah));
            }

            $file = $request->file('file_ijazah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/file');
            $file->move($destination, $filename);
            $ijazah->file_ijazah = 'uploads/file/' . $filename;
        }

        $ijazah->save();

        return redirect()->back()->with('success', 'Ijazah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ijazah = Ijazah::findOrFail($id);

        // Hapus file terkait jika ada
        if ($ijazah->file_ijazah && File::exists(public_path($ijazah->file_ijazah))) {
            File::delete(public_path($ijazah->file_ijazah));
        }

        $ijazah->delete();

        return redirect()->back()->with('success', 'Ijazah berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new IjazahExport, 'ijazah.xlsx');
    }
}
