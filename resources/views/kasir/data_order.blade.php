<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Data Order</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
        .order-card {
            transition: all 0.2s ease;
        }
        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .status-completed {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }
    </style>
</head>
<body class="bg-gray-50">
<!-- Sidebar Start -->
@include('components.sidebar_kasir')
<!-- Sidebar End -->

<!-- Main Content Start -->
<div class="ml-0 lg:ml-64 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Data Order</h1>
                <p class="text-gray-600 mt-1">Daftar semua order pelanggan</p>
            </div>
            <div class="flex gap-3">
                <div class="relative">
                    <input type="text" placeholder="Cari order..." class="w-full md:w-64 pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Filter Status</option>
                    <option>Semua</option>
                    <option>Diproses</option>
                    <option>Sudah Bisa Diambil</option>
                    <option>Selesai</option>
                </select>
            </div>
        </div>

        <!-- Order List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="grid grid-cols-12 gap-4 bg-gray-50 px-6 py-3 border-b font-medium text-gray-700">
                <div class="col-span-3">Pelanggan</div>
                <div class="col-span-2">Tanggal</div>
                <div class="col-span-2">Status</div>
                <div class="col-span-2 text-right">Subtotal</div>
                <div class="col-span-3">Aksi</div>
            </div>
            
            <!-- Order Items -->
            <div class="divide-y divide-gray-200" id="orderList">
                <!-- Order 1 -->
                <div class="order-card grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50" data-order-id="1">
                    <div class="col-span-3 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-medium">A</span>
                        </div>
                        <div>
                            <p class="font-medium">Tati</p>
                            <p class="text-sm text-gray-500">Sudah Dibayar</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center text-gray-600">09-09-2023</div>
                    <div class="col-span-2 flex items-center">
                        <span class="status-badge status-completed" onclick="cycleStatus(this)">Selesai</span>
                    </div>
                    <div class="col-span-2 flex items-center justify-end font-medium">Rp 25.000</div>
                    <div class="col-span-3 flex items-center gap-2">
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 px-3 py-1 border border-gray-200 rounded-lg text-sm">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                    </div>
                </div>
                
                <!-- Order 2 -->
                <div class="order-card grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50" data-order-id="2">
                    <div class="col-span-3 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-medium">A</span>
                        </div>
                        <div>
                            <p class="font-medium">Amay</p>
                            <p class="text-sm text-gray-500">Belum Lunas</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center text-gray-600">09-09-2023</div>
                    <div class="col-span-2 flex items-center">
                        <span class="status-badge status-processing" onclick="cycleStatus(this)">Diproses</span>
                    </div>
                    <div class="col-span-2 flex items-center justify-end font-medium">Rp 25.000</div>
                    <div class="col-span-3 flex items-center gap-2">
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 px-3 py-1 border border-gray-200 rounded-lg text-sm">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                    </div>
                </div>
                
                <!-- Order 3 -->
                <div class="order-card grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50" data-order-id="3">
                    <div class="col-span-3 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-medium">G</span>
                        </div>
                        <div>
                            <p class="font-medium">Gayar</p>
                            <p class="text-sm text-gray-500">Sudah Dibayar</p>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center text-gray-600">10-09-2023</div>
                    <div class="col-span-2 flex items-center">
                        <span class="status-badge status-pending" onclick="cycleStatus(this)">Sudah Bisa Diambil</span>
                    </div>
                    <div class="col-span-2 flex items-center justify-end font-medium">Rp 30.000</div>
                    <div class="col-span-3 flex items-center gap-2">
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                        <button class="text-gray-600 hover:text-gray-800 px-3 py-1 border border-gray-200 rounded-lg text-sm">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari <span class="font-medium">12</span> hasil
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
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
</div>
<!-- Main Content End -->

<script>
    // Urutan perubahan status
    const statusCycle = {
        'Diproses': {
            next: 'Sudah Bisa Diambil',
            class: 'status-pending',
            text: 'Sudah Bisa Diambil'
        },
        'Sudah Bisa Diambil': {
            next: 'Selesai',
            class: 'status-completed',
            text: 'Selesai'
        },
        'Selesai': {
            next: 'Diproses',
            class: 'status-pending',
            text: 'Diproses'
        }
    };

    // Fungsi untuk mengubah status secara siklus
    function cycleStatus(element) {
        const currentStatus = element.textContent;
        const nextStatus = statusCycle[currentStatus];
        
        // Hapus semua kelas status
        element.classList.remove('status-pending', 'status-processing', 'status-completed');
        
        // Update ke status berikutnya
        element.classList.add(nextStatus.class);
        element.textContent = nextStatus.text;
        
        // Dapatkan ID order
        const orderId = element.closest('[data-order-id]').getAttribute('data-order-id');
        
        // Di sini Anda bisa menambahkan AJAX untuk menyimpan perubahan status ke database
        console.log(`Order ID: ${orderId}, Status baru: ${nextStatus.text}`);
        
        // Untuk demo, kita tampilkan alert
        // alert(`Status order ${orderId} diubah menjadi ${nextStatus.text}`);
    }

    // Jika ingin konfirmasi sebelum mengubah status
    function cycleStatus(element) {
        const currentStatus = element.textContent;
        const nextStatus = statusCycle[currentStatus];
        
        if (confirm(`Ubah status dari ${currentStatus} menjadi ${nextStatus.text}?`)) {
            // Hapus semua kelas status
            element.classList.remove('status-pending', 'status-processing', 'status-completed');
            
            // Update ke status berikutnya
            element.classList.add(nextStatus.class);
            element.textContent = nextStatus.text;
            
            // Dapatkan ID order
            const orderId = element.closest('[data-order-id]').getAttribute('data-order-id');
            console.log(`Order ID: ${orderId}, Status baru: ${nextStatus.text}`);
        }
    }
    
</script>

</body>
</html>