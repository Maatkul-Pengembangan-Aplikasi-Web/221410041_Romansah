<x-app-layout>
    <!-- Header Section with Maroon Background (Full Width) -->
    <x-slot name="header">
        <div class="bg-[#800000] w-full py-8">
            <h2 id="greeting" class="font-semibold text-3xl text-white leading-tight text-center">
                <!-- The greeting text will be updated by JavaScript -->
            </h2>
        </div>
    </x-slot>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Full Screen Background Section with Gradient (Black, Maroon, Grey, Blue) -->
    <div class="py-12" style="background: linear-gradient(to right, #000000, #800000, #808080, #0000FF);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center text-white">
            <!-- Timer Countdown Section -->
            <div class="mb-6">
                <h3 class="text-2xl font-bold mb-4">Waktu Kelas Berikutnya:</h3>
                <div id="countdown-timer" class="text-4xl font-semibold">
                    <!-- Timer will appear here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Content below the Ads (Information Section with Maroon Background) -->
    <div class="bg-[#800000] text-white py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('mahasiswa.index') }}" class="bg-white shadow-lg rounded-lg p-6 text-center hover:bg-blue-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-users text-4xl text-indigo-500 mb-4"></i>
                    <h4 class="font-semibold text-xl text-gray-700">Mahasiswa</h4>
                    <p class="text-gray-600">Semester 5</p>
                </a>

                <a href="{{ route('/prodi') }}" class="bg-white shadow-lg rounded-lg p-6 text-center hover:bg-green-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-university text-4xl text-green-500 mb-4"></i>
                    <h4 class="font-semibold text-xl text-gray-700">Program Studi</h4>
                    <p class="text-gray-600">Fakultas Teknik</p>
                </a>

                <a href="{{ route('matakuliah.index') }}" class="bg-white shadow-lg rounded-lg p-6 text-center hover:bg-yellow-100 transition-all duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-book-open text-4xl text-yellow-500 mb-4"></i>
                    <h4 class="font-semibold text-xl text-gray-700">Mata Kuliah</h4>
                    <p class="text-gray-600">Mata Kuliah Aktif</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p class="text-sm">&copy; {{ date('Y') }} Copyright by: Omen. All rights reserved.</p>
        <div class="flex justify-center mt-2">
            <a href="https://www.instagram.com/im_omenn/" target="_blank" class="mx-2 text-white hover:text-gray-400 transition-colors">
                <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="https://www.tiktok.com/search?q=kevin_sky6&t=1732356764838" target="_blank" class="mx-2 text-white hover:text-gray-400 transition-colors">
                <i class="fab fa-tiktok text-xl"></i>
            </a>
            <a href="https://www.youtube.com" target="_blank" class="mx-2 text-white hover:text-gray-400 transition-colors">
                <i class="fab fa-youtube text-xl"></i>
            </a>
            <a href="https://web.facebook.com/profile.php?id=100029411961267" target="_blank" class="mx-2 text-white hover:text-gray-400 transition-colors">
                <i class="fab fa-facebook text-xl"></i>
            </a>
        </div>
    </footer>

    <!-- Add Bootstrap JS for carousel functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Countdown Timer Script -->
    <script>
        // Function to update the greeting based on the time of day
        function updateGreeting() {
            var now = new Date();
            var hours = now.getHours();
            var greetingText = "Hai, ";

            if (hours >= 0 && hours < 12) {
                greetingText += "Selamat Pagi";
            } else if (hours >= 12 && hours < 18) {
                greetingText += "Selamat Siang";
            } else {
                greetingText += "Selamat Malam";
            }

            // Set the greeting text in the header
            document.getElementById("greeting").innerHTML = greetingText + " " + "{{ Auth::user()->name }}";
        }

        // Call the function to set the greeting when the page loads
        updateGreeting();

        // Countdown Timer Function
        function checkClassTime() {
            var now = new Date();
            var currentDay = now.getDay();

            if (currentDay === 2) {
                var startClass1 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 31, 0);
                var endClass1 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 11, 0, 0);
                var startClass2 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 11, 1, 0);
                var endClass2 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 12, 30, 0);
                var startClass3 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 14, 31, 0);
                var endClass3 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 16, 45, 0);

                if (now >= startClass1 && now <= endClass1) {
                    return endClass1;
                } else if (now >= startClass2 && now <= endClass2) {
                    return endClass2;
                } else if (now >= startClass3 && now <= endClass3) {
                    return endClass3;
                } else if (now < startClass1) {
                    return startClass1;
                } else {
                    return null;
                }
            } else if (currentDay === 4) {
                var startClass = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 8, 0, 0);
                var endClass = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 9, 30, 0);

                if (now >= startClass && now <= endClass) {
                    return endClass;
                } else if (now < startClass) {
                    return startClass;
                } else {
                    return null;
                }
            }

            return null;
        }

        var countDownDate = checkClassTime();

        if (countDownDate) {
            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("countdown-timer").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown-timer").innerHTML = "Semua kelas hari ini telah selesai!";
                }
            }, 1000);
        } else {
            document.getElementById("countdown-timer").innerHTML = "Tidak ada kelas pada hari ini.";
        }
    </script>
</x-app-layout>
