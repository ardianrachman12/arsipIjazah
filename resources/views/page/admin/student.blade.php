@extends('layout.app')
@section('title', 'Student')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="p-4 d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Siswa</h3>
                <div class="d-flex">
                    <a href="{{ route('students.export.excel') }}" class="btn btn-success btn-sm mr-2">Export Excel</a>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createUserModal">+ Tambah
                        Siswa</button>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <table id="studentTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->nama_lengkap }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->jenis_kelamin }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editUserModal{{ $student->id }}">Detail</button>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                        class="d-inline" id="deleteForm{{ $student->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $student->id }})">Hapus</button>
                                    </form>
                                    <script>
                                        function confirmDelete(userId) {
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
                                                    document.getElementById('deleteForm' + userId).submit();
                                                }
                                            })
                                        }
                                    </script>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editUserModal{{ $student->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form action="{{ route('students.update', $student->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Siswa</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body d-flex" style="gap:20px;">
                                                        <div class="" style="width: 100%;">
                                                            <div class="form-group">
                                                                <label>NISN</label>
                                                                <input type="number" name="nisn" class="form-control"
                                                                    maxlength="10" value="{{ $student->nisn }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NIS</label>
                                                                <input type="number" name="nis" class="form-control"
                                                                    maxlength="10" value="{{ $student->nis }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input type="text" name="nama_lengkap"
                                                                    class="form-control"
                                                                    value="{{ $student->nama_lengkap }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jenis Kelamin</label>
                                                                <select name="jenis_kelamin" class="form-control" required>
                                                                    <option value="L"
                                                                        {{ $student->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="P"
                                                                        {{ $student->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prodi">Program Studi</label>
                                                                <select name="program_studi_id" class="form-control"
                                                                    id="" required>
                                                                    @foreach ($prodi as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $student->program_studi_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tempat Lahir</label>
                                                                <input type="text" name="tempat_lahir"
                                                                    class="form-control"
                                                                    value="{{ $student->tempat_lahir }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="" style="width: 100%;">
                                                            
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control"
                                                                    value="{{ $student->tanggal_lahir->format('Y-m-d') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Alamat</label>
                                                                <textarea name="alamat" class="form-control" required>{{ $student->alamat }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Orang Tua</label>
                                                                <input type="text" name="nama_orang_tua"
                                                                    class="form-control"
                                                                    value="{{ $student->nama_orang_tua }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No Telepon</label>
                                                                <input type="text" name="no_telepon" class="form-control"
                                                                    maxlength="15" value="{{ $student->no_telepon }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Angkatan</label>
                                                                <input type="number" name="angkatan" class="form-control"
                                                                    maxlength="4" value="{{ $student->angkatan }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Foto</label>
                                                                <input type="file" name="foto"
                                                                    class="form-control-file">

                                                                @if ($student->foto)
                                                                    <small class="form-text text-muted mt-2">
                                                                        Foto saat ini:
                                                                        <a href="{{ asset($student->foto) }}"
                                                                            data-lightbox="student-foto-{{ $student->id }}"
                                                                            data-title="Foto Siswa">
                                                                            <img src="{{ asset($student->foto) }}"
                                                                                alt="Foto Siswa" width="80"
                                                                                height="80"
                                                                                style="object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                                                                        </a>
                                                                    </small>
                                                                @endif
                                                            </div>
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
                                    <!-- End Edit Modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="/students/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="number" name="nisn" class="form-control" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="number" name="nis" class="form-control" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <select name="program_studi_id" class="form-control" id="" required>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nama Orang Tua</label>
                            <input type="text" name="nama_orang_tua" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control-file">
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
        let table = new DataTable('#studentTable', {
            responsive: true,
            autoWidth: false
        });
    </script>

@endsection
