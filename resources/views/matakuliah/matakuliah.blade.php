<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Mata Kuliah') }}
        </h2>
    </x-slot>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tombol Tambah dan Form Pencarian -->
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('mataKuliah.create') }}" class="inline-flex items-center px-4 py-2 bg-[#800000] border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-[#600000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i> Tambah Mata Kuliah
                </a>
                <form action="{{ route('mataKuliah.search') }}" method="GET" class="flex">
                    <input type="text" name="search" class="form-input rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Cari Mata Kuliah" value="{{ request('search') }}">
                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>

            <!-- Grid Daftar Mata Kuliah -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($mataKuliah as $mk)
                    <div class="bg-white shadow-lg rounded-lg p-6 relative">
                        <!-- Informasi Mata Kuliah -->
                        <h3 class="text-lg font-bold text-gray-700 mb-2">{{ $mk->nama }}</h3>
                        <p class="text-sm text-gray-600 mb-2">Kode: {{ $mk->kode }}</p>
                        <p class="text-sm text-gray-600 mb-2">SKS: {{ $mk->sks }}</p>
                        <p class="text-sm text-gray-600 mb-4">Dosen: {{ $mk->dosen }}</p>

                        <!-- Tombol Aksi -->
                        <div class="flex space-x-4">
                            <a href="{{ route('mataKuliah.rps', $mk->id) }}" class="btn btn-primary btn-sm">RPS</a>
                            <a href="{{ route('mataKuliah.pertemuan', $mk->id) }}" class="btn btn-secondary btn-sm">Pertemuan</a>
                            <a href="{{ route('mataKuliah.peserta', $mk->id) }}" class="btn btn-warning btn-sm">Peserta</a>
                        </div>

                        <!-- Tombol Hapus -->
                        <form id="delete-form-{{ $mk->id }}" action="{{ route('mataKuliah.destroy', $mk->id) }}" method="POST" class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-500 hover:text-red-700" onclick="confirmDelete({{ $mk->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center">
                        <p class="text-gray-600 text-lg">Tidak ada data mata kuliah yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

<!-- Tombol Kembali ke Dashboard (hanya tampil jika tidak ada pencarian) -->
@if(!request()->has('search') || request('search') == '')
    <div class="mt-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-[#800000] border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-[#600000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition ease-in-out duration-150">
            <i class="fas fa-arrow-left mr-2"></i> Back To Home
        </a>
    </div>
@endif

<!-- Tombol Kembali ke Halaman Sebelumnya (hanya tampil saat pencarian ada) -->
@if(request()->has('search') && request('search') != '')
    <div class="mt-8">
        <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-[#800000] border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-[#600000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition ease-in-out duration-150">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>
@endif

        </div>
    </div>

    <!-- Script SweetAlert -->
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
</x-app-layout>
