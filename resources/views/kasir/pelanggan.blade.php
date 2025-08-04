<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Daftar Pelanggan</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
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
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Pelanggan</h1>
            <p class="text-gray-600 mt-2">Manajemen data pelanggan laundry</p>
        </div>
        <button id="openModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition">
            <i class="fas fa-plus mr-2"></i> Tambah Pelanggan
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="relative flex-grow">
                <input type="text" placeholder="Cari pelanggan..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="flex gap-2">
                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Filter Status</option>
                    <option>Aktif</option>
                    <option>Non-Aktif</option>
                </select>
                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Urutkan</option>
                    <option>Nama A-Z</option>
                    <option>Nama Z-A</option>
                    <option>Terbaru</option>
                    <option>Terlama</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Pelanggan Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Telepon</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">K</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Kasif 1</div>
                                    <div class="text-sm text-gray-500">kasif1@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">+6280076578</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bojong Menteng</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    <!-- Data pelanggan lainnya -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content End -->

<<!-- Modal Tambah Pelanggan -->
    <div id="pelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
            <!-- Modal Header dengan tombol close -->
            <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Tambah Pelanggan</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form id="formPelanggan">
                <!-- Nama Pelanggan -->
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" id="nama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <!-- Nomor Handphone -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                    <div class="flex">
                        <div class="flex-shrink-0 w-16">
                            <select class="w-full px-2 py-2 border border-gray-300 rounded-l-md bg-gray-100 text-sm focus:outline-none">
                                <option>+62</option>
                                <option>+60</option>
                                <option>+65</option>
                            </select>
                        </div>
                        <input type="tel" id="phone" class="flex-grow px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                
                <!-- Provinsi -->
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <select id="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Provinsi</option>
                        <option>Jawa Barat</option>
                        <option>Jawa Tengah</option>
                        <option>Jawa Timur</option>
                    </select>
                </div>
                
                <!-- Kota -->
                <div class="mb-4">
                    <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <select id="kota" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kota</option>
                        <option>Bandung</option>
                        <option>Jakarta</option>
                        <option>Surabaya</option>
                    </select>
                </div>
                
                <!-- Kecamatan -->
                <div class="mb-4">
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <select id="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kecamatan</option>
                        <option>Coblong</option>
                        <option>Dago</option>
                        <option>Setiabudi</option>
                    </select>
                </div>
                
                <!-- Kode Pos -->
                <div class="mb-4">
                    <label for="kodepos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" id="kodepos" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <!-- Detail Alamat -->
                <div class="mb-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat (Nama Jalan, Gedung, No Rumah)</label>
                    <textarea id="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                
                <!-- Modal Footer -->
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
    const openBtn = document.getElementById('openModal');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('formPelanggan');

    // Open modal
    openBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    const closeModal = () => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        form.reset();
    };

    // Event listeners for closing
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Close when pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        // Process form data here
        closeModal();
    });
</script>

</body>
</html>