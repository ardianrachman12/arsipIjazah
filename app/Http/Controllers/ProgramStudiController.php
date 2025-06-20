<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::with('students')->get();
        return view('page.admin.program-studi', [
            'programStudi' => $programStudi
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:program_studis,name|max:255',
            'kode_program_studi' => 'required|unique:program_studis,kode_program_studi|max:10',
            'deskripsi' => 'nullable|max:500',
        ]);

        ProgramStudi::create($validated);

        return redirect()->back()->with('success', 'Program studi berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255|unique:program_studis,name,' . $programStudi->id,
            'kode_program_studi' => 'required|max:10|unique:program_studis,kode_program_studi,' . $programStudi->id,
            'deskripsi' => 'nullable|max:500',
        ]);

        $programStudi->update($validated);

        return redirect()->back()->with('success', 'Program studi berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        
        if($programStudi->students()->count() > 0) {
            return redirect()->back()->with('error', 'Program studi tidak dapat dihapus karena masih memiliki siswa!');
        }
        
        $programStudi->delete();
        return redirect()->back()->with('success', 'Program studi berhasil dihapus!');
    }
}
