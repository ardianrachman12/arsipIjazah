@extends('layout.app')
@section('title', 'Jurusan')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="p-4 d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Jurusan</h3>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createProdiModal">+ Tambah
                    Jurusan</button>
            </div>
            <div class="card-body overflow-auto">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jurusan</th>
                            <th>Kode</th>
                            <th>Total Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programStudi as $index => $prodi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prodi->name }}</td>
                                <td>{{ $prodi->kode_program_studi }}</td>
                                <td>{{ $prodi->students->count()  }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editUserModal{{ $prodi->id }}">Edit</button>
                                    <form action="{{ route('program-studi.destroy', $prodi->id) }}" method="POST"
                                        class="d-inline" id="deleteForm{{ $prodi->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $prodi->id }})">Hapus</button>
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
                                    <div class="modal fade" id="editUserModal{{ $prodi->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('program-studi.update', $prodi->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Jurusan</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Nama Jurusan</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $prodi->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kode</label>
                                                            <input type="text" name="kode_program_studi"
                                                                class="form-control"
                                                                value="{{ $prodi->kode_program_studi }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control">{{ $prodi->deskripsi }}</textarea>
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
    <div class="modal fade" id="createProdiModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="/program-studi/store" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Jurusan</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Jurusan</label>
                            <input type="text" name="kode_program_studi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
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
@endsection
