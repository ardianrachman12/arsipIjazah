@extends('layout.app')
@section('title', 'Ijazah')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="p-4 d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Ijazah</h3>
                <div class="d-flex">
                    <a href="{{ route('ijazah.export.excel') }}" class="btn btn-success btn-sm mr-2">Export Excel</a>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createIjazahModal">+ Tambah
                        Ijazah</button>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Ijazah</th>
                            <th>Nomor Seri</th>
                            <th>Program Studi</th>
                            <th>Verifikasi</th>
                            <th>File</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ijazahs as $index => $ijazah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ijazah->student->nama_lengkap }}</td>
                                <td>{{ $ijazah->nomor_ijazah }}</td>
                                <td>{{ $ijazah->nomor_seri }}</td>
                                <td>{{ $ijazah->student->programstudi->kode_program_studi }}</td>
                                <td class="text-center">
                                    @if ($ijazah->status_verifikasi)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-times text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($ijazah->file_ijazah)
                                        <a href="{{ asset('/' . $ijazah->file_ijazah) }}" target="_blank">Lihat File Saat
                                            Ini</a><br>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </td>
                                <td>{{ date('d M Y', strtotime($ijazah->tanggal_terbit)) }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editIjazahModal{{ $ijazah->id }}">Edit</button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('ijazah.destroy', $ijazah->id) }}" method="POST"
                                        class="d-inline" id="deleteForm{{ $ijazah->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $ijazah->id }})">Hapus</button>
                                    </form>
                                    <script>
                                        function confirmDelete(ijazahId) {
                                            Swal.fire({
                                                title: 'Apakah Anda yakin?',
                                                text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, hapus!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('deleteForm' + ijazahId).submit();
                                                }
                                            })
                                        }
                                    </script>

                                    <!-- Modal Edit Ijazah -->
                                    <div class="modal fade" id="editIjazahModal{{ $ijazah->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('ijazah.update', $ijazah->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Ijazah</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Siswa</label>
                                                            <select name="student_id" class="tom-select" required>
                                                                <option value="">-- Pilih Siswa --</option>
                                                                @foreach ($students as $student)
                                                                    <option value="{{ $student->id }}"
                                                                        {{ $ijazah->student_id == $student->id ? 'selected' : '' }}>
                                                                        {{ $student->nama_lengkap }}
                                                                        ({{ $student->nisn }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor Ijazah</label>
                                                            <input type="text" name="nomor_ijazah" class="form-control"
                                                                value="{{ $ijazah->nomor_ijazah }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor Seri</label>
                                                            <input type="text" name="nomor_seri" class="form-control"
                                                                value="{{ $ijazah->nomor_seri }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Program Studi</label>
                                                            <input disabled type="text" name="program_studi"
                                                                class="form-control"
                                                                value="{{ $ijazah->student->programstudi->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Lulus</label>
                                                            <input type="number" name="tahun_lulus" class="form-control"
                                                                value="{{ $ijazah->tahun_lulus }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nilai Rata-Rata</label>
                                                            <input type="text" name="nilai_rata_rata"
                                                                class="form-control" value="{{ $ijazah->nilai_rata_rata }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>File Ijazah</label><br>
                                                            @if ($ijazah->file_ijazah)
                                                                <a href="{{ asset('/' . $ijazah->file_ijazah) }}"
                                                                    target="_blank">Lihat File Saat Ini</a><br>
                                                            @endif
                                                            <input type="file" name="file_ijazah"
                                                                class="form-control-file mt-1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea name="keterangan" class="form-control">{{ $ijazah->keterangan }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status Verifikasi</label>
                                                            <select name="status_verifikasi" class="form-control">
                                                                <option value="0"
                                                                    {{ !$ijazah->status_verifikasi ? 'selected' : '' }}>
                                                                    Belum
                                                                    Diverifikasi</option>
                                                                <option value="1"
                                                                    {{ $ijazah->status_verifikasi ? 'selected' : '' }}>
                                                                    Sudah
                                                                    Diverifikasi</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Terbit</label>
                                                            <input type="date" name="tanggal_terbit" class="form-control"
                                                                value="{{ $ijazah->tanggal_terbit->format('Y-m-d') }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Ijazah Modal -->
    <div class="modal fade" id="createIjazahModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('ijazah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Ijazah</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Siswa</label>
                            <select name="student_id" class="tom-select" required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->nama_lengkap }}
                                        ({{ $student->nisn }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nomor Ijazah</label>
                            <input type="text" name="nomor_ijazah" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nomor Seri</label>
                            <input type="text" name="nomor_seri" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tahun Lulus</label>
                            <input type="number" name="tahun_lulus" class="form-control" min="1900" max="2099"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Nilai Rata-rata</label>
                            <input type="text" name="nilai_rata_rata" class="form-control" maxlength="5" required>
                        </div>

                        <div class="form-group">
                            <label>Scan Ijazah (PDF/JPG/PNG)</label>
                            <input type="file" name="file_ijazah" class="form-control-file"
                                accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <div class="form-group">
                            <label>Status Verifikasi</label>
                            <select name="status_verifikasi" class="form-control">
                                <option value="0">
                                    Belum
                                    Diverifikasi</option>
                                <option value="1">
                                    Sudah
                                    Diverifikasi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Terbit</label>
                            <input type="date" name="tanggal_terbit" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        let table = new DataTable('#userTable', {
            responsive: true,
            autoWidth: false
        });
    </script>
    <script>
        $(document).on('shown.bs.modal', function() {
            document.querySelectorAll('.tom-select').forEach(function(el) {
                if (!el.classList.contains('ts-loaded')) {
                    new TomSelect(el, {
                        create: false,
                        sortField: {
                            field: "text",
                            direction: "asc"
                        }
                    });
                    el.classList.add('ts-loaded');
                }
            });
        });
    </script>

@endsection
