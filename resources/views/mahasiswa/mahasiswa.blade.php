<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Tombol Tambah Mahasiswa -->
                    <div class="mb-4">
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                            Tambah Mahasiswa
                        </a>
                    </div>

                    <!-- Tabel Mahasiswa -->
                    <table class="table table-hover">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Prodi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $index => $mhs)
                                <tr>
                                    <!-- Seluruh kolom diberi class text-center -->
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mhs->nama }}</td>
                                    <td class="text-center">{{ $mhs->npm }}</td>
                                    <td class="text-center">{{ $mhs->prodi }}</td>
                                    <td class="text-center">
                                        @if ($mhs->foto)
                                            <!-- Gambar kecil dengan klik -->
                                            <img 
                                                src="{{ Storage::url($mhs->foto) }}" 
                                                alt="Foto" 
                                                width="50" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal" 
                                                data-image="{{ Storage::url($mhs->foto) }}"
                                                style="cursor: pointer;">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form id="delete-form-{{ $mhs->id }}" action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $mhs->id }})">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                        
                    </table>

                    <!-- Tombol Kembali ke Dashboard -->
                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-house"></i> Back To Home
                        </a>
                    </div>

                    <!-- Modal Bootstrap -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center d-flex flex-column align-items-center justify-content-center">
                                    <!-- Gambar yang diubah ukurannya -->
                                    <img id="modalImage" src="" alt="Foto Mahasiswa" class="img-fluid" style="max-height: 80vh; width: auto;">

                                    <!-- Tombol Kembali -->
                                    <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SweetAlert2 -->
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
                                    document.getElementById('delete-form-' + id).submit();
                                }
                            });
                        }

                        // Modal Gambar
                        const imageModal = document.getElementById('imageModal');
                        imageModal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const image = button.getAttribute('data-image');
                            const modalImage = document.getElementById('modalImage');
                            modalImage.src = image;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
