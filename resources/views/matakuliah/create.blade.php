<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mataKuliah.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Mata Kuliah</label>
                        <input type="text" id="nama" name="nama" class="form-input rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="kode" class="block text-gray-700 font-bold mb-2">Kode</label>
                        <input type="text" id="kode" name="kode" class="form-input rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="sks" class="block text-gray-700 font-bold mb-2">SKS</label>
                        <input type="number" id="sks" name="sks" class="form-input rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="dosen" class="block text-gray-700 font-bold mb-2">Dosen</label>
                        <input type="text" id="dosen" name="dosen" class="form-input rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="px-4 py-2 bg-[#800000] text-white font-bold rounded hover:bg-[#600000]">Simpan</button>
                        <a href="{{ route('matakuliah.index') }}" class="px-4 py-2 bg-gray-500 text-white font-bold rounded hover:bg-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
