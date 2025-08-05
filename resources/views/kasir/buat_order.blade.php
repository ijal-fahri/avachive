<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Buat Order</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
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
<!-- Sidebar Start -->
@include('components.sidebar_kasir')
<!-- Sidebar End -->

<!-- Main Content Start -->
<div class="ml-0 lg:ml-64 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
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

        <!-- Main Content Grid -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Services Section -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Layanan</h2>
                        <div class="relative w-64">
                            <input type="text" placeholder="Cari layanan..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Services List -->
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Service 1 -->
                        <div class="service-card border rounded-lg p-4 hover:border-blue-400 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">Cuci Kering</h3>
                                    <div class="flex gap-4 mt-1">
                                        <p class="text-sm text-gray-600">Kategori: <span class="text-gray-800">Khoan</span></p>
                                        <p class="text-sm text-gray-600">Patent: <span class="text-gray-800">Standard</span></p>
                                    </div>
                                </div>
                                <div class="text-right flex flex-col items-end">
                                    <p class="font-bold text-blue-600">Rp 7.000</p>
                                    <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Service 2 -->
                        <div class="service-card border rounded-lg p-4 hover:border-blue-400 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">Cuci Setrika</h3>
                                    <div class="flex gap-4 mt-1">
                                        <p class="text-sm text-gray-600">Kategori: <span class="text-gray-800">Khoan</span></p>
                                        <p class="text-sm text-gray-600">Patent: <span class="text-gray-800">Standard</span></p>
                                    </div>
                                </div>
                                <div class="text-right flex flex-col items-end">
                                    <p class="font-bold text-blue-600">Rp 12.000</p>
                                    <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Service 3 -->
                        <div class="service-card border rounded-lg p-4 hover:border-blue-400 cursor-pointer">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">Bed Cover</h3>
                                    <div class="flex gap-4 mt-1">
                                        <p class="text-sm text-gray-600">Kategori: <span class="text-gray-800">Satsani</span></p>
                                        <p class="text-sm text-gray-600">Patent: <span class="text-gray-800">Standard</span></p>
                                    </div>
                                </div>
                                <div class="text-right flex flex-col items-end">
                                    <p class="font-bold text-blue-600">Rp 10.000</p>
                                    <button class="mt-2 px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition">
                                        + Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky-summary">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Ringkasan Order</h2>
                    
                    <!-- Selected Services -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-700 mb-3">Layanan yang Dipilih:</h3>
                        <div class="space-y-3">
                            <div class="border rounded-lg p-3 bg-gray-50">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-gray-800">Cuci Kering</p>
                                        <p class="text-xs text-gray-500">Kategori: Satsani</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-gray-800">Rp 7.000</span>
                                        <div class="flex items-center border rounded quantity-control">
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100 w-8">-</button>
                                            <span class="px-2 text-center flex-grow">1</span>
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100 w-8">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total Harga:</span>
                            <span class="font-bold text-lg text-blue-600">Rp 7.000</span>
                        </div>
                    </div>

                    <!-- Order Options -->
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                            <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option>Non Tunai</option>
                                <option>Tunai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Pembayaran</label>
                            <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option>Bayar Sekarang</option>
                                <option>Bayar Nanti</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pengambilan</label>
                            <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option>Ambil Sendiri</option>
                                <option>Diantar</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customer Selection Modal -->
<div id="customerModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white/95 rounded-xl shadow-xl w-full max-w-md max-h-[90vh] flex flex-col border border-gray-200">
        <!-- Modal Header -->
        <div class="border-b px-6 py-4 flex justify-between items-center bg-white rounded-t-xl">
            <h2 class="text-xl font-semibold text-gray-800">Pilih Pelanggan</h2>
            <button id="closeCustomerModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-4 flex-1 flex flex-col bg-white/95">
            <div class="relative mb-4">
                <input type="text" id="customerSearch" placeholder="Cari pelanggan..." 
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <div class="flex-1 overflow-y-auto modal-content bg-white/95 rounded-b-xl">
                <!-- Customers List -->
                <div class="customer-list space-y-2">
                    <!-- Customer 1 -->
                    <div class="customer-item border rounded-lg p-4 hover:bg-gray-50 transition cursor-pointer bg-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">Budi Santoso</p>
                                <p class="text-sm text-gray-600">+628123456789</p>
                            </div>
                            <button class="select-customer-btn px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition" 
                                    data-name="Budi Santoso" data-phone="+628123456789">
                                Pilih
                            </button>
                        </div>
                    </div>
                    
                    <!-- Customer 2 -->
                    <div class="customer-item border rounded-lg p-4 hover:bg-gray-50 transition cursor-pointer bg-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">Ani Wijaya</p>
                                <p class="text-sm text-gray-600">+628987654321</p>
                            </div>
                            <button class="select-customer-btn px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition"
                                    data-name="Ani Wijaya" data-phone="+628987654321">
                                Pilih
                            </button>
                        </div>
                    </div>
                    
                    <!-- Customer 3 -->
                    <div class="customer-item border rounded-lg p-4 hover:bg-gray-50 transition cursor-pointer bg-white">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">Citra Dewi</p>
                                <p class="text-sm text-gray-600">+628567891234</p>
                            </div>
                            <button class="select-customer-btn px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition"
                                    data-name="Citra Dewi" data-phone="+628567891234">
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Customer Modal Functionality
    const customerModal = document.getElementById('customerModal');
    const openCustomerModalBtn = document.getElementById('openCustomerModal');
    const closeCustomerModalBtn = document.getElementById('closeCustomerModal');
    const customerSearch = document.getElementById('customerSearch');
    const selectedCustomerDisplay = document.getElementById('selectedCustomerDisplay');
    const customerNameDisplay = document.getElementById('customerName');
    const customerPhoneDisplay = document.getElementById('customerPhone');
    const clearCustomerBtn = document.getElementById('clearCustomer');

    // Open modal
    openCustomerModalBtn.addEventListener('click', () => {
        customerModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    const closeCustomerModal = () => {
        customerModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    closeCustomerModalBtn.addEventListener('click', closeCustomerModal);

    // Clear selected customer
    clearCustomerBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        selectedCustomerDisplay.classList.add('hidden');
        document.querySelectorAll('.customer-item').forEach(item => {
            item.classList.remove('selected-customer');
        });
    });

    // Search functionality
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

    // Select customer
    document.querySelectorAll('.select-customer-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const phone = this.getAttribute('data-phone');
            
            customerNameDisplay.textContent = name;
            customerPhoneDisplay.textContent = phone;
            selectedCustomerDisplay.classList.remove('hidden');
            
            // Highlight selected customer in modal
            document.querySelectorAll('.customer-item').forEach(item => {
                item.classList.remove('selected-customer');
            });
            this.closest('.customer-item').classList.add('selected-customer');
            
            closeCustomerModal();
        });
    });

    // Close with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !customerModal.classList.contains('hidden')) {
            closeCustomerModal();
        }
    });

    // Quantity controls
    document.querySelectorAll('.quantity-control button').forEach(button => {
        button.addEventListener('click', function() {
            const span = this.parentElement.querySelector('span');
            let quantity = parseInt(span.textContent);
            
            if (this.textContent === '+' || this.innerHTML.includes('+')) {
                quantity++;
            } else if (quantity > 1) {
                quantity--;
            }
            
            span.textContent = quantity;
            // Update total price here
        });
    });
</script>
</body>
</html>