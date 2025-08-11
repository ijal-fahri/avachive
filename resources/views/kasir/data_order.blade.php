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
            background: rgba(0, 0, 0, 0.5);
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

        .btn-green,
        .btn-gray {
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
                    <form action="{{ route('kasir.dataorder.index') }}" method="GET" class="flex gap-3">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari order..."
                                class="w-full md:w-64 pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ request('search') }}">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select name="status" onchange="this.form.submit()"
                            class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Filter Status">Filter Status</option>
                            <option value="Semua" @if (request('status') == 'Semua') selected @endif>Semua</option>
                            <option value="Diproses" @if (request('status') == 'Diproses') selected @endif>Diproses</option>
                            <option value="Sudah Bisa Diambil" @if (request('status') == 'Sudah Bisa Diambil') selected @endif>Sudah
                                Bisa Diambil</option>
                            <option value="Selesai" @if (request('status') == 'Selesai') selected @endif>Selesai</option>
                        </select>
                    </form>
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
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="divide-y divide-gray-200" id="orderList">
                        @foreach ($orders as $order)
                            <div class="order-card grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50"
                                data-order-id="{{ $order->id }}">
                                <div class="col-span-3 flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <span
                                            class="text-blue-600 font-medium">{{ strtoupper(substr($order->pelanggan->nama, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $order->pelanggan->nama }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->waktu_pembayaran }}</p>
                                    </div>
                                </div>
                                <div class="col-span-2 flex items-center text-gray-600">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                                </div>
                                <div class="col-span-2 flex items-center">
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
                                    <span class="status-badge {{ $statusClass }}"
                                        onclick="cycleStatus(this)">{{ $order->status }}</span>
                                </div>
                                <div class="col-span-2 flex items-center justify-end font-medium">Rp
                                    {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                                <div class="col-span-3 flex items-center gap-2">
                                    <button
                                        class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn"
                                        data-order="{{ json_encode($order) }}">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </button>
                                    <button
                                        class="text-gray-600 hover:text-gray-800 px-3 py-1 border border-gray-200 rounded-lg text-sm">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" aria-current="page"
                                    class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                <a href="#"
                                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                <a href="#"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
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
                            @foreach ($historyOrders as $order)
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <span
                                                    class="text-blue-600 font-medium">{{ strtoupper(substr($order->pelanggan->nama, 0, 1)) }}</span>
                                            </div>
                                            <div>
                                                <p class="font-medium">{{ $order->pelanggan->nama }}</p>
                                                <p class="text-sm text-gray-500">{{ $order->pelanggan->no_handphone }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $layanan = json_decode($order->layanan, true);
                                            echo implode(', ', array_column($layanan, 'nama'));
                                        @endphp
                                    </td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td><span class="history-badge badge-completed">{{ $order->status }}</span></td>
                                    <td>
                                        <button
                                            class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn"
                                            data-order="{{ json_encode($order) }}">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
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
                class: 'status-pending'
            },
            'Sudah Bisa Diambil': {
                next: 'Selesai',
                class: 'status-completed'
            },
            'Selesai': {
                next: 'Diproses',
                class: 'status-processing'
            }
        };

        // Modal functionality
        const modal = document.getElementById('detailModal');
        const detailContent = document.getElementById('detailContent');
        const confirmModal = document.getElementById('confirmStatusModal');
        const confirmContent = document.getElementById('confirmStatusContent');
        const confirmBtn = document.getElementById('confirmStatusBtn');
        let currentStatusElement = null;
        let nextStatus = null;

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
*Alamat:* ${orderData.pelanggan.provinsi.kota.kecamatan.detail_alamat}
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

        // Event listener tombol detail
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
                const formattedPhone = formatPhoneNumber(orderData.pelanggan.no_handphone);

                detailContent.innerHTML = `
                <p><strong>Nama:</strong> ${orderData.pelanggan.nama}</p>
                <p><strong>No HP:</strong> ${formattedPhone}</p>
                <p><strong>Alamat:</strong> ${orderData.pelanggan.alamat}</p>
                <p><strong>Pengambilan:</strong> ${orderData.metode_pengambilan}</p>
                <p><strong>Pembayaran:</strong> ${orderData.metode_pembayaran}</p>
                <p><strong>Waktu Order:</strong> ${new Date(orderData.created_at).toLocaleString('id-ID', { year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                <div class="mt-4">
                    <h5 class="font-semibold">Detail Layanan:</h5>
                    ${layananHtml}
                </div>
                <p class="text-xl font-bold mt-4">Total: Rp ${parseInt(orderData.total_harga).toLocaleString('id-ID')}</p>
                <div class="button-group">
                    <button class="btn-green" id="whatsappBtn"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                    <a href="http://maps.google.com/?q=${encodeURIComponent(orderData.pelanggan.alamat)}" class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i> Buka Maps</a>
                </div>
            `;
                modal.style.display = "flex";

                document.getElementById('whatsappBtn').addEventListener('click', () => {
                    openWhatsApp(orderData);
                });
            });
        });

        // Fungsi untuk memicu modal konfirmasi status
        function cycleStatus(element) {
            const currentStatus = element.textContent.trim();
            const nextStatusData = statusCycle[currentStatus];

            if (!nextStatusData) {
                alert("Status tidak dikenal");
                return;
            }

            nextStatus = nextStatusData.next;
            currentStatusElement = element;

            confirmContent.innerHTML = `
            <p>Anda yakin ingin mengubah status order ini?</p>
            <p class="font-bold mt-2">${currentStatus} → ${nextStatus}</p>
        `;
            confirmModal.style.display = "flex";
        }

        // Kirim permintaan ubah status ke server
        function changeStatus() {
            const orderId = currentStatusElement.closest('[data-order-id]').getAttribute('data-order-id');

            fetch(`{{ url('kasir/data_order') }}/${orderId}/status`, {
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
