<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Program Studi') }}
        </h2>
    </x-slot>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Notifikasi Sukses -->
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <!-- Tombol Tambah dan Form Pencarian -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('prodi/create') }}" class="btn btn-primary btn-sm">Tambah Program Studi</a>
                        <form action="{{ route('prodi.search') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Program Studi" value="{{ request('search') }}">
                            <button class="btn btn-primary btn-sm ml-2" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </form>
                    </div>

                    <!-- Tabel Program Studi -->
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodis as $prodi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prodi->nama }}</td>
                                    <td>
                                        <a href="{{ route('prodi/edit', $prodi->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <form id="delete-form-{{ $prodi->id }}" action="{{ route('prodi/delete', $prodi->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $prodi->id }})">Hapus</button>
                                        </form>                                        
                                    </td>
                                </tr>
                            @endforeach
                            <script>
                                function confirmDelete(id) {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Data yang dihapus tidak dapat dikembalikan!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No',
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Submit form jika pengguna memilih Yes
                                            document.getElementById('delete-form-' + id).submit();
                                        }
                                    });
                                }
                            </script>
                            
                        </tbody>
                    </table>

                    <!-- Tombol Back -->
                    @if (request()->has('search') && request('search') != '')
                        <div class="mt-3">
                            <a href="{{ route('prodi.search') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
