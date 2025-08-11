<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Buat Order</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Gaya CSS */
        .modal-content {
            max-height: 70vh;
            overflow-y: auto;
        }
        .selected-customer {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
        }
        .service-card {
            transition: all 0.2s ease;
        }
        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .quantity-control {
            width: 100px;
        }
        .sticky-summary {
            position: sticky;
            top: 1rem;
        }
    </style>
</head>
<body class="bg-gray-50">
@include('components.sidebar_kasir')
<div class="ml-0 lg:ml-64 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Buat Order Baru</h1>
                <p class="text-gray-600 mt-1">Pilih layanan untuk order baru</p>
            </div>
            <div class="w-full md:w-auto">
                <button id="openCustomerModal" class="w-full md:w-auto bg-blue-100 text-blue-600 px-4 py-2 rounded-lg flex items-center justify-center hover:bg-blue-200 transition">
                    <i class="fas fa-user-plus mr-2"></i> Pilih Pelanggan
                </button>
                <div id="selectedCustomerDisplay" class="hidden mt-2 p-3 bg-blue-50 rounded-lg border border-blue-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-blue-700" id="customerName"></p>
                            <p class="text-sm text-blue-600" id="customerPhone"></p>
                        </div>
                        <button id="clearCustomer" class="text-blue-400 hover:text-blue-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form id="orderForm" action="{{ route('buat_order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="tambah_pelanggan_id" id="tambah_pelanggan_id">
            <input type="hidden" name="layanan" id="layanan_input">
            <input type="hidden" name="total_harga" id="total_harga_input">

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">Daftar Layanan</h2>
                            <div class="relative w-64">
                                <input type="text" placeholder="Cari layanan..." id="serviceSearch" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 service-list">
                            @foreach ($layanans as $layanan)
                            <div class="service-card border rounded-lg p-4 hover:border-blue-400 cursor-pointer" data-id="{{ $layanan->id }}" data-nama="{{ $layanan->nama }}" data-harga="{{ $layanan->harga }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800">{{ $layanan->nama }}</h3>
                                        <div class="flex gap-4 mt-1">
                                            <p class="text-sm text-gray-600">Kategori: <span class="text-gray-800">{{ $layanan->kategori }}</span></p>
                                            <p class="text-sm text-gray-600">Satuan: <span class="text-gray-800">{{ $layanan->satuan }}</span></p>
                                        </div>
                                    </div>
                                    <div class="text-right flex flex-col items-end">
                                        <p class="font-bold text-blue-600">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
                                        <button type="button" class="mt-2 px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition add-service-btn">
                                            + Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky-summary">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Ringkasan Order</h2>
                        
                        <div class="mb-6">
                            <h3 class="font-medium text-gray-700 mb-3">Layanan yang Dipilih:</h3>
                            <div id="selectedServicesList" class="space-y-3">
                                </div>
                        </div>

                        <div class="border-t pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-800">Total Harga:</span>
                                <span id="totalPriceDisplay" class="font-bold text-lg text-blue-600">Rp 0</span>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div>
                                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="Non Tunai">Non Tunai</option>
                                    <option value="Tunai">Tunai</option>
                                </select>
                            </div>
                            <div>
                                <label for="waktu_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Waktu Pembayaran</label>
                                <select name="waktu_pembayaran" id="waktu_pembayaran" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="Bayar Sekarang">Bayar Sekarang</option>
                                    <option value="Bayar Nanti">Bayar Nanti</option>
                                </select>
                            </div>
                            <div>
                                <label for="metode_pengambilan" class="block text-sm font-medium text-gray-700 mb-2">Metode Pengambilan</label>
                                <select name="metode_pengambilan" id="metode_pengambilan" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                                    <option value="Diantar">Diantar</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" id="submitOrderBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="customerModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white/95 rounded-xl shadow-xl w-full max-w-md max-h-[90vh] flex flex-col border border-gray-200">
        <div class="border-b px-6 py-4 flex justify-between items-center bg-white rounded-t-xl">
            <h2 class="text-xl font-semibold text-gray-800">Pilih Pelanggan</h2>
            <button id="closeCustomerModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="p-4 flex-1 flex flex-col bg-white/95">
            <div class="relative mb-4">
                <input type="text" id="customerSearch" placeholder="Cari pelanggan..." 
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <div class="flex-1 overflow-y-auto modal-content bg-white/95 rounded-b-xl">
                <div class="customer-list space-y-2">
                    @foreach ($pelanggans as $pelanggan)
                    <div class="customer-item border rounded-lg p-4 hover:bg-gray-50 transition cursor-pointer bg-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">{{ $pelanggan->nama }}</p>
                                <p class="text-sm text-gray-600">{{ $pelanggan->no_handphone }}</p>
                            </div>
                            <button type="button" class="select-customer-btn px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition" 
                                    data-id="{{ $pelanggan->id }}" data-name="{{ $pelanggan->nama }}" data-phone="{{ $pelanggan->no_handphone }}">
                                Pilih
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data Layanan yang dipilih
    let selectedServices = {};

    // Customer Modal Functionality
    const customerModal = document.getElementById('customerModal');
    const openCustomerModalBtn = document.getElementById('openCustomerModal');
    const closeCustomerModalBtn = document.getElementById('closeCustomerModal');
    const customerSearch = document.getElementById('customerSearch');
    const selectedCustomerDisplay = document.getElementById('selectedCustomerDisplay');
    const customerNameDisplay = document.getElementById('customerName');
    const customerPhoneDisplay = document.getElementById('customerPhone');
    const clearCustomerBtn = document.getElementById('clearCustomer');
    const customerIdInput = document.getElementById('tambah_pelanggan_id');
    const orderForm = document.getElementById('orderForm');
    const submitOrderBtn = document.getElementById('submitOrderBtn');

    openCustomerModalBtn.addEventListener('click', () => {
        customerModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    const closeCustomerModal = () => {
        customerModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    closeCustomerModalBtn.addEventListener('click', closeCustomerModal);

    clearCustomerBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        selectedCustomerDisplay.classList.add('hidden');
        document.querySelectorAll('.customer-item').forEach(item => {
            item.classList.remove('selected-customer');
        });
        customerIdInput.value = ''; // Clear customer ID
    });

    customerSearch.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const customerItems = document.querySelectorAll('.customer-item');
        
        customerItems.forEach(item => {
            const name = item.querySelector('p.font-medium').textContent.toLowerCase();
            const phone = item.querySelector('p.text-sm').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || phone.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.select-customer-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const phone = this.getAttribute('data-phone');
            
            customerNameDisplay.textContent = name;
            customerPhoneDisplay.textContent = phone;
            selectedCustomerDisplay.classList.remove('hidden');
            
            customerIdInput.value = id; // Set customer ID
            
            document.querySelectorAll('.customer-item').forEach(item => {
                item.classList.remove('selected-customer');
            });
            this.closest('.customer-item').classList.add('selected-customer');
            
            closeCustomerModal();
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !customerModal.classList.contains('hidden')) {
            closeCustomerModal();
        }
    });

    // Services Functionality
    const selectedServicesList = document.getElementById('selectedServicesList');
    const totalPriceDisplay = document.getElementById('totalPriceDisplay');
    const serviceSearchInput = document.getElementById('serviceSearch');
    const servicesContainer = document.querySelector('.service-list');

    const updateSummary = () => {
        let total = 0;
        selectedServicesList.innerHTML = '';
        const servicesArray = [];

        for (const id in selectedServices) {
            const service = selectedServices[id];
            total += service.price * service.quantity;
            servicesArray.push({
                id: service.id,
                nama: service.name,
                harga: service.price,
                kuantitas: service.quantity
            });

            // Buat elemen HTML untuk ringkasan
            const summaryItem = document.createElement('div');
            summaryItem.className = 'border rounded-lg p-3 bg-gray-50';
            summaryItem.innerHTML = `
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800">${service.name}</p>
                        <p class="text-xs text-gray-500">Kategori: ${service.category}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-gray-800">Rp ${service.price.toLocaleString('id-ID')}</span>
                        <div class="flex items-center border rounded quantity-control" data-id="${id}">
                            <button type="button" class="px-2 py-1 text-gray-600 hover:bg-gray-100 w-8 minus-btn">-</button>
                            <span class="px-2 text-center flex-grow">${service.quantity}</span>
                            <button type="button" class="px-2 py-1 text-gray-600 hover:bg-gray-100 w-8 plus-btn">+</button>
                        </div>
                    </div>
                </div>
            `;
            selectedServicesList.appendChild(summaryItem);
        }

        totalPriceDisplay.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        document.getElementById('total_harga_input').value = total;
        document.getElementById('layanan_input').value = JSON.stringify(servicesArray);
    };

    // Menambah layanan ke ringkasan
    document.querySelectorAll('.add-service-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const serviceCard = this.closest('.service-card');
            const id = serviceCard.dataset.id;
            const name = serviceCard.dataset.nama;
            const price = parseInt(serviceCard.dataset.harga);
            const category = serviceCard.querySelector('span.text-gray-800').textContent;

            if (selectedServices[id]) {
                selectedServices[id].quantity++;
            } else {
                selectedServices[id] = { id, name, price, category, quantity: 1 };
            }
            updateSummary();
        });
    });

    // Mengubah kuantitas
    selectedServicesList.addEventListener('click', function(e) {
        const target = e.target;
        if (target.classList.contains('minus-btn') || target.classList.contains('plus-btn')) {
            const quantityControl = target.closest('.quantity-control');
            const id = quantityControl.dataset.id;
            
            if (target.classList.contains('minus-btn')) {
                if (selectedServices[id].quantity > 1) {
                    selectedServices[id].quantity--;
                } else {
                    delete selectedServices[id];
                }
            } else if (target.classList.contains('plus-btn')) {
                selectedServices[id].quantity++;
            }
            updateSummary();
        }
    });

    // Pencarian layanan
    serviceSearchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('.service-card').forEach(card => {
            const name = card.dataset.nama.toLowerCase();
            if (name.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Form Submission Handler
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable tombol submit untuk mencegah multiple clicks
        submitOrderBtn.disabled = true;
        submitOrderBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        
        // Kirim data form dengan AJAX
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                tambah_pelanggan_id: customerIdInput.value,
                layanan: document.getElementById('layanan_input').value,
                total_harga: document.getElementById('total_harga_input').value,
                metode_pembayaran: document.getElementById('metode_pembayaran').value,
                waktu_pembayaran: document.getElementById('waktu_pembayaran').value,
                metode_pengambilan: document.getElementById('metode_pengambilan').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tampilkan SweetAlert sukses
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Order berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        // Redirect setelah alert ditutup
                        window.location.href = "data_order"; // Ganti dengan URL yang sesuai
                    }
                });
            } else {
                // Tampilkan error jika ada
                Swal.fire({
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan saat menyimpan order',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                submitOrderBtn.disabled = false;
                submitOrderBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Order';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan saat menyimpan order',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            submitOrderBtn.disabled = false;
            submitOrderBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Order';
        });
    });
</script>
</body>
</html>