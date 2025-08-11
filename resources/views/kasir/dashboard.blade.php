<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
        .modal {
            transition: opacity 0.3s ease;
        }
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body class="bg-gray-50">
<!-- Sidebar Start -->
@include('components.sidebar_kasir')
<!-- Sidebar End -->

<!-- Main Content Start -->
<div class="ml-0 lg:ml-64 min-h-screen p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Selamat Datang di Dashboard</h1>
        <p class="text-gray-600 mt-2">Ringkasan aktivitas laundry Anda</p>
    </div>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Ringkasan Laporan Card -->
        <div class="bg-white rounded-xl shadow-md p-6 col-span-1 md:col-span-2">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Ringkasan Laporan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-600">Pendapatan Hari Ini</p>
                    <p class="font-bold text-lg">Rp 40.000</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-green-600">Order Hari Ini</p>
                    <p class="font-bold text-lg">2</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-sm text-purple-600">Order Bulan Ini</p>
                    <p class="font-bold text-lg">15</p>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm text-yellow-600">Pelanggan</p>
                    <p class="font-bold text-lg">3</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Aksi Cepat</h2>
            <div class="space-y-3">
                <a href="buat_order" class="block">
                    <button class="w-full flex items-center justify-between p-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                        <span>Buat Order Baru</span>
                        <i class="fas fa-plus"></i>
                    </button>
                </a>
                <button id="openModalFromQuickAction" class="w-full flex items-center justify-between p-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                    <span>Tambah Pelanggan</span>
                    <i class="fas fa-user-plus"></i>
                </button>
                <a href="data_order" class="block">
                    <button class="w-full flex items-center justify-between p-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition">
                        <span>Lihat Semua Order</span>
                        <i class="fas fa-list"></i>
                    </button>
                </a>
            </div>
        </div>

        <!-- Kelola Laundry Card -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Kelola Laundry</h2>
            <div class="grid grid-cols-2 gap-4">
                <a href="layanan" class="text-center p-4 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                    <div class="text-blue-600 text-3xl mb-2">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <p class="text-sm font-semibold">Layanan</p>
                    <p class="text-xs text-gray-600">2 Layanan aktif</p>
                </a>
                <a href="pelanggan" class="text-center p-4 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                    <div class="text-green-600 text-3xl mb-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="text-sm font-semibold">Pelanggan</p>
                    <p class="text-xs text-gray-600">5 Pelanggan</p>
                </a>
                <a href="data_order" class="text-center p-4 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                    <div class="text-purple-600 text-3xl mb-2">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <p class="text-sm font-semibold">Data Order</p>
                    <p class="text-xs text-gray-600">15 Order</p>
                </a>
                <a href="pengaturan" class="text-center p-4 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                    <div class="text-yellow-600 text-3xl mb-2">
                        <i class="fas fa-cog"></i>
                    </div>
                    <p class="text-sm font-semibold">Pengaturan</p>
                    <p class="text-xs text-gray-600">Konfigurasi sistem</p>
                </a>
            </div>
        </div>

        <!-- Recent Orders Card -->
        <div class="bg-white rounded-xl shadow-md p-6 col-span-1 md:col-span-2 lg:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Order Terakhir</h2>
                <a href="data_order" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Mei 2023</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 25.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ani Wijaya</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">13 Mei 2023</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 35.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Main Content End -->

<!-- Pelanggan Modal -->
<div id="pelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 pb-10 bg-white/50 backdrop-blur-sm transition-opacity overflow-y-auto">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 my-8 modal-content" style="max-height: 80vh; overflow-y: auto;">
        <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Tambah Pelanggan</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    
        <div class="p-6">
            <form id="formPelanggan" action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" name="nama" id="nama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="no_handphone" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                    <div class="flex">
                        <input type="tel" name="no_handphone" id="no_handphone" class="flex-grow px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="provinsi" id="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="kota" id="kota" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="kodepos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="kodepos" id="kodepos" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-6">
                    <label for="detail_alamat" class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat (Nama Jalan, Gedung, No Rumah)</label>
                    <textarea name="detail_alamat" id="detail_alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" id="cancelBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">Kembali</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal functionality
    const modal = document.getElementById('pelangganModal');
    const openQuickActionBtn = document.getElementById('openModalFromQuickAction');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const backdrop = document.querySelector('.modal-backdrop');

    // Open modal from quick action
    openQuickActionBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    const closeModal = () => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Event listeners for closing
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);

    // Close when pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>

</body>
</html>