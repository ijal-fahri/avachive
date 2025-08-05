<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Data Order</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* Tambahkan di bagian CSS */
        .mt-4 {
            margin-top: 1rem;
        }

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
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #888;
            cursor: pointer;
        }

        .service-box {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .btn-green, .btn-gray {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-green {
            background-color: #2ecc71;
            color: white;
        }

        .btn-gray {
            background-color: #dfe4ea;
            color: #2d3436;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        /* Footer modal styles */
        .modal-footer {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        
        /* Riwayat Order Styles */
        .history-section {
            margin-top: 40px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .history-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .history-table th {
            text-align: left;
            padding: 12px 15px;
            background: #f8f9fa;
            font-weight: 500;
            color: #555;
            border-bottom: 2px solid #eee;
        }
        
        .history-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .history-table tr:last-child td {
            border-bottom: none;
        }
        
        .history-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 15px;
        }
        
        .history-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-completed {
            background-color: #dcfce7;
            color: #166534;
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
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn"
                            data-nama="Tati" data-hp="085712345678" data-alamat="Ciomas" 
                            data-alamat-lengkap="Jawa Barat, Bogor, Ciomas" data-pengambilan="Ambil Sendiri"
                            data-pembayaran="NonTunai" data-waktu-bayar="Bayar Sekarang" 
                            data-waktu-order="04-08-2025 09:30" data-layanan="Cuci Sepatu"
                            data-kategori="Satuan" data-harga="25000" data-jumlah="1" 
                            data-subtotal="25000">
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
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn"
                            data-nama="Amay" data-hp="081234567890" data-alamat="Bogor Utara" 
                            data-alamat-lengkap="Bogor Utara, Jawa Barat" data-pengambilan="Diantar"
                            data-pembayaran="Tunai" data-waktu-bayar="Bayar Dulu" 
                            data-waktu-order="04-08-2025 08:00" data-layanan="Setrika Baju"
                            data-kategori="Kiloan" data-harga="15000" data-jumlah="2" 
                            data-subtotal="30000">
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
                        <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn"
                            data-nama="Gayar" data-hp="087812345678" data-alamat="Bogor Selatan" 
                            data-alamat-lengkap="Bogor Selatan, Jawa Barat" data-pengambilan="Ambil Sendiri"
                            data-pembayaran="NonTunai" data-waktu-bayar="Bayar Sekarang" 
                            data-waktu-order="10-09-2023 10:45" data-layanan="Cuci Karpet"
                            data-kategori="Satuan" data-harga="30000" data-jumlah="1" 
                            data-subtotal="30000">
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
        
        <!-- Riwayat Order Selesai -->
        <div class="history-section mt-8">
            <h3 class="history-title">Riwayat Order Selesai</h3>
            <div class="history-container">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Layanan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Riwayat 1 -->
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">A</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">Ahmad</p>
                                        <p class="text-sm text-gray-500">081234567890</p>
                                    </div>
                                </div>
                            </td>
                            <td>01-08-2025</td>
                            <td>Cuci Kiloan</td>
                            <td>Rp 45.000</td>
                            <td><span class="history-badge badge-completed">Selesai</span></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Riwayat 2 -->
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">B</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">Budi</p>
                                        <p class="text-sm text-gray-500">082345678901</p>
                                    </div>
                                </div>
                            </td>
                            <td>30-07-2025</td>
                            <td>Cuci Sepatu</td>
                            <td>Rp 75.000</td>
                            <td><span class="history-badge badge-completed">Selesai</span></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Riwayat 3 -->
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">C</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">Citra</p>
                                        <p class="text-sm text-gray-500">083456789012</p>
                                    </div>
                                </div>
                            </td>
                            <td>28-07-2025</td>
                            <td>Setrika Baju</td>
                            <td>Rp 35.000</td>
                            <td><span class="history-badge badge-completed">Selesai</span></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Riwayat 4 -->
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">D</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">Dewi</p>
                                        <p class="text-sm text-gray-500">084567890123</p>
                                    </div>
                                </div>
                            </td>
                            <td>25-07-2025</td>
                            <td>Cuci Karpet</td>
                            <td>Rp 120.000</td>
                            <td><span class="history-badge badge-completed">Selesai</span></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Riwayat 5 -->
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">E</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">Eka</p>
                                        <p class="text-sm text-gray-500">085678901234</p>
                                    </div>
                                </div>
                            </td>
                            <td>20-07-2025</td>
                            <td>Cuci Kiloan</td>
                            <td>Rp 55.000</td>
                            <td><span class="history-badge badge-completed">Selesai</span></td>
                            <td>
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Main Content End -->

<!-- Modal Detail Order -->
<div class="modal" id="detailModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <h4 class="text-xl font-bold mb-4">Detail Order</h4>
        <div id="detailContent"></div>
    </div>
</div>

<!-- Modal Konfirmasi Ubah Status -->
<div class="modal" id="confirmStatusModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeConfirmModal()">&times;</span>
        <h4 class="text-xl font-bold mb-4">Konfirmasi Ubah Status</h4>
        <div id="confirmStatusContent"></div>
        <div class="button-group mt-4">
            <button class="btn-gray" onclick="closeConfirmModal()">Batal</button>
            <button class="btn-green" id="confirmStatusBtn">Ya, Ubah Status</button>
        </div>
    </div>
</div>

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
            class: 'status-processing',
            text: 'Diproses'
        }
    };

    // Modal functionality
    const modal = document.getElementById('detailModal');
    const detailContent = document.getElementById('detailContent');

    // Fungsi untuk memformat nomor telepon
    function formatPhoneNumber(phoneNumber) {
        // Hilangkan semua karakter non-digit
        const cleaned = ('' + phoneNumber).replace(/\D/g, '');
        
        // Format sesuai standar Indonesia
        if (cleaned.length === 12 && cleaned.startsWith('628')) {
            return cleaned.replace(/(\d{3})(\d{3})(\d{4})(\d{2})/, '+$1 $2-$3-$4');
        } else if (cleaned.length === 11 && cleaned.startsWith('08')) {
            return cleaned.replace(/(\d{2})(\d{3})(\d{4})(\d{2})/, '+62 $1 $2-$3-$4');
        } else if (cleaned.length === 10 && cleaned.startsWith('8')) {
            return cleaned.replace(/(\d{3})(\d{3})(\d{4})/, '+62 $1-$2-$3');
        }
        return phoneNumber; // Kembalikan as-is jika format tidak dikenali
    }

    // Fungsi untuk membuka WhatsApp
    function openWhatsApp(phoneNumber) {
        // Hilangkan semua karakter non-digit
        const cleaned = ('' + phoneNumber).replace(/\D/g, '');
        
        // Konversi ke format internasional jika dimulai dengan 0
        let whatsappNumber = cleaned;
        if (cleaned.startsWith('0')) {
            whatsappNumber = '62' + cleaned.substring(1);
        } else if (cleaned.startsWith('8')) {
            whatsappNumber = '62' + cleaned;
        }
        
        window.open(`https://wa.me/${whatsappNumber}`, '_blank');
    }

    // Event listener untuk tombol detail
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const data = btn.dataset;
            const total = parseInt(data.harga) * parseInt(data.jumlah);
            const formattedPhone = formatPhoneNumber(data.hp);

            detailContent.innerHTML = `
                <p><strong>Nama:</strong> ${data.nama}</p>
                <p><strong>No HP:</strong> ${formattedPhone}</p>
                <p><strong>Alamat:</strong> ${data.alamat}</p>
                <p><strong>Alamat Lengkap:</strong> ${data.alamatLengkap}</p>
                <p><strong>Pengambilan:</strong> ${data.pengambilan}</p>
                <p><strong>Pembayaran:</strong> ${data.pembayaran}</p>
                <p><strong>Waktu Bayar:</strong> ${data.waktuBayar}</p>
                <p><strong>Waktu Order:</strong> ${data.waktuOrder}</p>
                <div class="service-box">
                    ${data.layanan}<br/>
                    Kategori: ${data.kategori}<br/>
                    Harga: Rp ${parseInt(data.harga).toLocaleString()}<br/>
                    Jumlah: ${data.jumlah}<br/>
                    Subtotal: Rp ${parseInt(data.subtotal).toLocaleString()}
                </div>
                <p><strong>Total:</strong> Rp ${total.toLocaleString()}</p>
                <div class="button-group">
                    <button class="btn-green" onclick="openWhatsApp('${data.hp}')"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                    <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.alamatLengkap)}"
                        class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i> Buka Maps</a>
                </div>
            `;
            modal.style.display = "flex";
        });
    });

    // Modal Konfirmasi Ubah Status
    const confirmModal = document.getElementById('confirmStatusModal');
    const confirmContent = document.getElementById('confirmStatusContent');
    const confirmBtn = document.getElementById('confirmStatusBtn');

    let currentStatusElement = null;
    let nextStatus = null;

    function cycleStatus(element) {
        const currentStatus = element.textContent;
        nextStatus = statusCycle[currentStatus];
        currentStatusElement = element;
        
        // Tampilkan modal konfirmasi
        confirmContent.innerHTML = `
            <p>Anda yakin ingin mengubah status order dari:</p>
            <p class="font-bold">${currentStatus} → ${nextStatus.text}</p>
        `;
        confirmModal.style.display = "flex";
    }

    // Fungsi untuk mengubah status setelah dikonfirmasi
    function changeStatus() {
        // Hapus semua kelas status
        currentStatusElement.classList.remove('status-pending', 'status-processing', 'status-completed');
        
        // Update ke status berikutnya
        currentStatusElement.classList.add(nextStatus.class);
        currentStatusElement.textContent = nextStatus.text;
        
        // Dapatkan ID order
        const orderId = currentStatusElement.closest('[data-order-id]').getAttribute('data-order-id');
        console.log(`Order ID: ${orderId}, Status baru: ${nextStatus.text}`);
        
        // Tutup modal
        closeConfirmModal();
    }

    // Event listener untuk tombol konfirmasi
    confirmBtn.addEventListener('click', changeStatus);

    function closeModal() {
        modal.style.display = "none";
    }

    function closeConfirmModal() {
        confirmModal.style.display = "none";
        currentStatusElement = null;
        nextStatus = null;
    }

    window.onclick = function(e) {
        if (e.target === modal) closeModal();
        if (e.target === confirmModal) closeConfirmModal();
    }
</script>
</body>
</html>