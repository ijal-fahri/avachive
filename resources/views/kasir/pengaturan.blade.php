<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Pengaturan</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
        .setting-card {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .setting-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-left-color: #3b82f6;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Sidebar Start -->
    @include('components.sidebar_kasir')
    <!-- Sidebar End -->

    <!-- Main Content Start -->
    <div class="ml-0 lg:ml-64 min-h-screen p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Pengaturan</h1>
                <p class="text-gray-600 mt-1">Kelola pengaturan akun dan aplikasi</p>
            </div>

            <!-- Profile Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <div class="profile-avatar bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        SM
                    </div>
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-bold text-gray-800">Sitha Marino</h2>
                        <p class="text-gray-600 mb-4">Kasir</p>
                    </div>
                </div>
            </div>

            <!-- Support & About Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Support & About</h2>

                <div class="space-y-3">
                    <!-- Tutorial -->
                    <div class="setting-card p-4 border rounded-lg cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium">Tutorial Penggunaan Aplikasi</h3>
                                    <p class="text-sm text-gray-500">Panduan lengkap menggunakan aplikasi</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </div>

                    <!-- About App -->
                    <div class="setting-card p-4 border rounded-lg cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium">Tentang Aplikasi</h3>
                                    <p class="text-sm text-gray-500">Informasi versi dan pengembang</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Section -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Action</h2>

                <div class="space-y-3">
                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 hover:bg-red-100 text-red-600 font-medium rounded-lg transition-colors duration-200 border border-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->

    <script>
        // Fungsi untuk tombol logout
        document.querySelectorAll('.setting-card').forEach(card => {
            card.addEventListener('click', function() {
                const action = this.querySelector('h3').textContent;

                if (action === 'Log Out') {
                    if (confirm('Apakah Anda yakin ingin keluar?')) {
                        // Redirect ke halaman logout
                        window.location.href = '/logout';
                    }
                } else if (action === 'Tutorial Penggunaan Aplikasi') {
                    // Buka tutorial
                    alert('Membuka tutorial penggunaan aplikasi');
                } else if (action === 'Tentang Aplikasi') {
                    // Buka tentang aplikasi
                    alert('Membuka informasi tentang aplikasi');
                }
            });
        });

        // Fungsi untuk edit profil
        document.querySelector('button').addEventListener('click', function() {
            // Buka modal/edit profil
            alert('Membuka form edit profil');
        });
    </script>

</body>

</html>
