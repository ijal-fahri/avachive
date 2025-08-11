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
        
        /* Modal styles */
        .modal-overlay {
            transition: opacity 0.3s ease;
            backdrop-filter: blur(4px);
        }
        
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
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
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $user->usertype }}</p>
                    </div>
                </div>
            </div>

            <!-- Support & About Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">About</h2>

                <div class="space-y-3">
                    <!-- About App -->
                    <div id="aboutAppCard" class="setting-card p-4 border rounded-lg cursor-pointer">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-4">
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

    <!-- About Application Modal -->
    <div id="aboutAppModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="modal-overlay absolute inset-0 bg-white/50 backdrop-blur-sm"></div>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md modal-content relative">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Tentang Aplikasi</h3>
                    <button id="closeAboutModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-tshirt text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800">Laundry Management System</h4>
                            <p class="text-sm text-gray-600">Versi 1.0.0</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-gray-700 mb-3">Aplikasi ini dirancang untuk membantu pengelolaan bisnis laundry dengan fitur:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Manajemen order laundry</li>
                            <li>Manajemen pelanggan</li>
                            <li>Laporan keuangan</li>
                            <li>Manajemen layanan</li>
                            <li>Monitoring status order</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button id="closeAboutBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // About Application Modal
        const aboutModal = document.getElementById('aboutAppModal');
        const aboutCard = document.getElementById('aboutAppCard');
        const closeAboutBtn = document.getElementById('closeAboutBtn');
        const closeAboutModalBtn = document.getElementById('closeAboutModal');
        const modalOverlay = document.querySelector('.modal-overlay');

        // Open about modal
        aboutCard.addEventListener('click', () => {
            aboutModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        // Close about modal
        const closeAboutModal = () => {
            aboutModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        closeAboutBtn.addEventListener('click', closeAboutModal);
        closeAboutModalBtn.addEventListener('click', closeAboutModal);
        modalOverlay.addEventListener('click', closeAboutModal);

        // Close when pressing Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !aboutModal.classList.contains('hidden')) {
                closeAboutModal();
            }
        });

        // Remove the old click handlers
        document.querySelectorAll('.setting-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (this.id === 'aboutAppCard') {
                    e.stopPropagation(); // Prevent the old alert from showing
                }
            });
        });
    </script>

</body>
</html>