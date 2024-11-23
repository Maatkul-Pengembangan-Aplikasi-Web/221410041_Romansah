<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Profil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tombol Kembali -->
            <div class="flex justify-start mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-[#800000] border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-[#600000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <!-- Update Profile Information -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Perbarui Informasi Profil</h3>
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        @include('profile.partials.update-profile-information-form')
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Ubah Kata Sandi</h3>
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @include('profile.partials.update-password-form')
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold text-red-700 mb-4">Hapus Akun</h3>
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @include('profile.partials.delete-user-form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
