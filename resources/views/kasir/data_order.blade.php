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
        /* Tambahkan ini di bagian style */
    .services-container {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 0.5rem;
        margin-top: 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
    }
    
    /* Custom scrollbar untuk container layanan */
    .services-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .services-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .services-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .services-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
        /* Improved Table Styles */
        .order-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.875rem;
        }
        
        .order-table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
        }
        
        .order-table tbody tr {
            transition: background-color 0.2s ease;
        }
        
        .order-table tbody tr:hover {
            background-color: #f8fafc;
        }
        
        .order-table td {
            padding: 1rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
            color: #334155;
        }
        
        .order-table td:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }
        
        .order-table td:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        
        .customer-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .customer-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background-color: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0369a1;
            font-weight: 500;
            flex-shrink: 0;
        }
        
        .customer-info {
            display: flex;
            flex-direction: column;
        }
        
        .customer-name {
            font-weight: 500;
            color: #1e293b;
        }
        
        .order-date {
            color: #64748b;
            font-size: 0.8125rem;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
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
        
        .price-cell {
            font-weight: 500;
            text-align: right;
        }
        
        .action-cell {
            display: flex;
            gap: 0.5rem;
        }
        
        .action-btn {
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .detail-btn {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        
        .detail-btn:hover {
            background-color: #dbeafe;
        }
        
        .status-btn {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .status-btn:hover {
            background-color: #dcfce7;
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
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.25rem;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        
        .modal-close:hover {
            color: #64748b;
        }
        
        .service-box {
            background-color: #f8fafc;
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin: 0.5rem 0;
            border: 1px solid #e2e8f0;
        }
        
        .button-group {
            margin-top: 1.5rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }
        
        .btn-green,
        .btn-gray {
            padding: 0.625rem 1rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.2s ease;
        }
        
        .btn-green {
            background-color: #22c55e;
            color: white;
        }
        
        .btn-green:hover {
            background-color: #16a34a;
        }
        
        .btn-gray {
            background-color: #f1f5f9;
            color: #334155;
        }
        
        .btn-gray:hover {
            background-color: #e2e8f0;
        }
        
        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-top: 1px solid #e2e8f0;
            background-color: white;
        }
        
        .pagination-info {
            color: #64748b;
            font-size: 0.875rem;
        }
        
        .pagination-controls {
            display: flex;
            gap: 0.25rem;
        }
        
        .page-btn {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            background-color: white;
            color: #64748b;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .page-btn:hover {
            background-color: #f1f5f9;
        }
        
        .page-btn.active {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
                    <form action="{{ route('kasir.dataorder.index') }}" method="GET" class="flex gap-3">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari order..."
                                class="w-full md:w-64 pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('search') }}">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-right">Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = ($orders->currentPage() - 1) * $orders->perPage() + 1;
                            @endphp
                            @foreach ($orders as $order)
                            <tr data-order-id="{{ $order->id }}" class="hover:bg-gray-50">
                                <td>{{ $no++ }}</td>
                                <td>
                                    <div class="customer-cell">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($order->pelanggan->nama, 0, 1)) }}
                                        </div>
                                        <div class="customer-info">
                                            <span class="customer-name">{{ $order->pelanggan->nama }}</span>
                                            <span class="order-date">{{ $order->waktu_pembayaran }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                                </td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        if ($order->status == 'Selesai') {
                                            $statusClass = 'status-completed';
                                        } elseif ($order->status == 'Diproses') {
                                            $statusClass = 'status-processing';
                                        } else {
                                            $statusClass = 'status-pending';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ $order->status }}</span>
                                </td>
                                <td class="price-cell">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    <div class="action-cell">
                                        <button class="action-btn detail-btn" data-order="{{ json_encode($order) }}">
                                            <i class="fas fa-eye"></i>
                                            <span class="hidden sm:inline">Detail</span>
                                        </button>
                                        <button class="action-btn status-btn change-status-btn" data-order-id="{{ $order->id }}" data-current-status="{{ $order->status }}">
                                            <i class="fas fa-sync-alt"></i>
                                            <span class="hidden sm:inline">Ubah Status</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination flex flex-col md:flex-row md:justify-between md:items-center gap-2 mt-4">
                    <div class="pagination-info text-sm text-gray-600 mb-2 md:mb-0">
                        Menampilkan <span class="font-medium">{{ $orders->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $orders->lastItem() }}</span>
                        dari <span class="font-medium">{{ $orders->total() }}</span> hasil
                    </div>
                    <nav class="pagination-controls flex gap-1" aria-label="Pagination">
                        {{-- Previous Page Link --}}
                        @if ($orders->onFirstPage())
                            <span class="page-btn disabled" aria-disabled="true"><i class="bi bi-chevron-left"></i></span>
                        @else
                            <a href="{{ $orders->previousPageUrl() }}" class="page-btn" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            @if ($page == $orders->currentPage())
                                <span class="page-btn active" aria-current="page">{{ $page }}</span>
                            @elseif ($page == 1 || $page == $orders->lastPage() || ($page >= $orders->currentPage() - 1 && $page <= $orders->currentPage() + 1))
                                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                            @elseif ($page == $orders->currentPage() - 2 || $page == $orders->currentPage() + 2)
                                <span class="page-btn disabled">...</span>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($orders->hasMorePages())
                            <a href="{{ $orders->nextPageUrl() }}" class="page-btn" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></a>
                        @else
                            <span class="page-btn disabled" aria-disabled="true"><i class="bi bi-chevron-right"></i></span>
                        @endif
                    </nav>
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
            <div class="button-group">
                <button class="btn-gray" onclick="closeConfirmModal()">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button class="btn-green" id="confirmStatusBtn">
                    <i class="fas fa-check"></i> Ya, Ubah Status
                </button>
            </div>
        </div>
    </div>

    <script>
        // Urutan perubahan status
        const statusCycle = {
            'Diproses': {
                next: 'Sudah Bisa Diambil',
                class: 'status-processing'
            },
            'Sudah Bisa Diambil': {
                next: 'Selesai',
                class: 'status-pending'
            },
            'Selesai': {
                next: 'Diproses',
                class: 'status-completed'
            }
        };

        // Modal functionality
        const modal = document.getElementById('detailModal');
        const detailContent = document.getElementById('detailContent');
        const confirmModal = document.getElementById('confirmStatusModal');
        const confirmContent = document.getElementById('confirmStatusContent');
        const confirmBtn = document.getElementById('confirmStatusBtn');
        let currentOrderId = null;
        let nextStatus = null;
        let currentStatus = null;

        // Format nomor telepon
function formatPhoneNumber(phoneNumber) {
        const cleaned = ('' + phoneNumber).replace(/\D/g, '');
        if (cleaned.length === 12 && cleaned.startsWith('628')) {
            return cleaned.replace(/(\d{3})(\d{3})(\d{4})(\d{2})/, '+$1 $2-$3-$4');
        } else if (cleaned.length === 11 && cleaned.startsWith('08')) {
            return cleaned.replace(/(\d{2})(\d{3})(\d{4})(\d{2})/, '+62 $1 $2-$3-$4');
        } else if (cleaned.length === 10 && cleaned.startsWith('8')) {
            return cleaned.replace(/(\d{3})(\d{3})(\d{4})/, '+62 $1-$2-$3');
        }
        return phoneNumber;
    }


        // Fungsi untuk membuat dan membuka pesan WhatsApp
        function openWhatsApp(orderData) {
        const cleanedPhone = ('' + orderData.pelanggan.no_handphone).replace(/\D/g, '');
        let whatsappNumber = cleanedPhone.startsWith('0') ? '62' + cleanedPhone.substring(1) : cleanedPhone;

        const layanan = JSON.parse(orderData.layanan);
        const waktuOrder = new Date(orderData.created_at).toLocaleString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

            // Membuat array string untuk setiap layanan dengan format rapi
         const layananMessages = layanan.map(item => {
            return `*Nama Layanan:* ${item.nama}
*Kategori:* Satuan
*Harga:* Rp ${parseInt(item.harga).toLocaleString('id-ID')}
*Jumlah:* ${item.kuantitas}
*Subtotal:* Rp ${(item.harga * item.kuantitas).toLocaleString('id-ID')}`;
        });

            // Gabungkan dengan pemisah
           const layananMessage = layananMessages.join('\n----------------\n');

            // Membuat pesan utama
            const message = `*📌 Detail Pelanggan*
*Nama:* ${orderData.pelanggan.nama}
*No Handphone:* ${formatPhoneNumber(orderData.pelanggan.no_handphone)}
*Alamat:* ${orderData.pelanggan.alamat}
*Metode Pengambilan:* ${orderData.metode_pengambilan}
*Waktu Pembayaran:* ${orderData.waktu_pembayaran}

*📌 Detail Layanan*
${layananMessage}

*📌 Rincian Pembayaran*
*Subtotal:* Rp ${parseInt(orderData.total_harga).toLocaleString('id-ID')}
*Ongkir:* Rp 0
*Total Harga:* Rp ${parseInt(orderData.total_harga).toLocaleString('id-ID')}
*Uang Diberikan:* Rp 0
*Kembalian:* Rp 0

*📌 Status Order*
${orderData.status}

*📌 Metode Pembayaran*
${orderData.metode_pembayaran}

*📌 Waktu Order*
${waktuOrder}`;

        const encodedMessage = encodeURIComponent(message.trim());
        window.open(`https://wa.me/${whatsappNumber}?text=${encodedMessage}`, '_blank');
    }

       document.querySelectorAll('.detail-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const orderData = JSON.parse(btn.dataset.order);
        const layanan = JSON.parse(orderData.layanan);

        let layananHtml = '';
        layanan.forEach(item => {
            layananHtml += `
                <div class="service-box">
                    <strong>${item.nama}</strong><br/>
                    Harga: Rp ${parseInt(item.harga).toLocaleString('id-ID')}<br/>
                    Jumlah: ${item.kuantitas}<br/>
                    Subtotal: Rp ${(item.harga * item.kuantitas).toLocaleString('id-ID')}
                </div>
            `;
        });

        // Gabungkan seluruh data alamat dari pelanggan
        let alamatLengkap = '-';
        if (orderData.pelanggan) {
            const provinsi = orderData.pelanggan.provinsi ?? '';
            const kota = orderData.pelanggan.kota ?? '';
            const kecamatan = orderData.pelanggan.kecamatan ?? '';
            const kodepos = orderData.pelanggan.kodepos ?? '';
            const detail_alamat = orderData.pelanggan.detail_alamat ?? '';
            // Format: [detail_alamat], [kecamatan], [kota], [provinsi], [kodepos]
            alamatLengkap = `${provinsi}, ${kota}, ${kecamatan}, ${detail_alamat}, ${kodepos}`.replace(/^, |, $/g, '').replace(/(, ){2,}/g, ', ');
        }

        const formattedPhone = formatPhoneNumber(orderData.pelanggan.no_handphone);

        detailContent.innerHTML = `
            <div class="space-y-3">
                <p><strong>Nama:</strong> ${orderData.pelanggan.nama}</p>
                <p><strong>No HP:</strong> ${formattedPhone}</p>
                <p><strong>Alamat:</strong> ${alamatLengkap}</p>
                <p><strong>Pengambilan:</strong> ${orderData.metode_pengambilan}</p>
                <p><strong>Pembayaran:</strong> ${orderData.metode_pembayaran}</p>
                <p><strong>Waktu Order:</strong> ${new Date(orderData.created_at).toLocaleString('id-ID', { year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                <div class="mt-4">
                    <h5 class="font-semibold text-gray-700">Detail Layanan:</h5>
                    <div class="services-container" style="max-height:200px;overflow-y:auto;">
                        ${layananHtml}
                    </div>
                </div>
                <p class="text-xl font-bold mt-4 text-right">Total: Rp ${parseInt(orderData.total_harga).toLocaleString('id-ID')}</p>
            </div>
            <div class="button-group">
                <button class="btn-green" id="whatsappBtn"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                <a href="http://maps.google.com/?q=${encodeURIComponent(alamatLengkap)}" class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i> Buka Maps</a>
            </div>
        `;
        modal.style.display = "flex";

        document.getElementById('whatsappBtn').addEventListener('click', () => {
            openWhatsApp(orderData);
        });
    });
});

        // Event listener untuk tombol ubah status
        document.querySelectorAll('.change-status-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                currentOrderId = this.getAttribute('data-order-id');
                currentStatus = this.getAttribute('data-current-status');
                const nextStatusData = statusCycle[currentStatus];

                if (!nextStatusData) {
                    alert("Status tidak dikenal");
                    return;
                }

                nextStatus = nextStatusData.next;

                confirmContent.innerHTML = `
                <p>Anda yakin ingin mengubah status order ini?</p>
                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <span class="status-badge ${getStatusClass(currentStatus)}">${currentStatus}</span>
                        <i class="fas fa-arrow-right text-gray-500 mx-2"></i>
                        <span class="status-badge ${nextStatusData.class}">${nextStatus}</span>
                    </div>
                </div>
            `;
                confirmModal.style.display = "flex";
            });
        });

        // Fungsi untuk mendapatkan class status berdasarkan status
        function getStatusClass(status) {
            if (status == 'Selesai') {
                return 'status-completed';
            } else if (status == 'Diproses') {
                return 'status-processing';
            } else {
                return 'status-pending';
            }
        }

        // Kirim permintaan ubah status ke server
        function changeStatus() {
            fetch(`{{ url('kasir/data_order') }}/${currentOrderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: nextStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        window.location.reload();
                    } else {
                        alert('Gagal mengubah status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengubah status. Silakan coba lagi.');
                });
        }

        // Event listener tombol konfirmasi
        confirmBtn.addEventListener('click', changeStatus);

        // Fungsi close modal
        function closeModal() {
            modal.style.display = "none";
        }

        function closeConfirmModal() {
            confirmModal.style.display = "none";
            currentOrderId = null;
            nextStatus = null;
            currentStatus = null;
        }

        window.onclick = function(e) {
            if (e.target === modal) closeModal();
            if (e.target === confirmModal) closeConfirmModal();
        }
    </script>
</body>

</html>