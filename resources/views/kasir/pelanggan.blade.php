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
@include('components.sidebar_kasir')
<div class="ml-0 lg:ml-64 min-h-screen p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Pelanggan</h1>
            <p class="text-gray-600 mt-2">Manajemen data pelanggan laundry</p>
        </div>
        <button id="openModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition">
            <i class="fas fa-plus mr-2"></i> Tambah Pelanggan
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
        <form action="{{ route('pelanggan.index') }}" method="GET">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="relative flex-grow">
                    <input type="text" name="search" placeholder="Cari pelanggan..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Cari</button>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

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
                    @foreach ($pelanggans as $pelanggan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($pelanggans->currentPage() - 1) * $pelanggans->perPage() + $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">{{ substr($pelanggan->nama, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pelanggan->nama }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelanggan->no_handphone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelanggan->kecamatan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button class="text-blue-600 hover:text-blue-900 mr-3 detail-pelanggan-btn" 
                                data-nama="{{ $pelanggan->nama }}" 
                                data-phone="{{ $pelanggan->no_handphone }}" 
                                data-provinsi="{{ $pelanggan->provinsi }}" 
                                data-kota="{{ $pelanggan->kota }}" 
                                data-kecamatan="{{ $pelanggan->kecamatan }}" 
                                data-kodepos="{{ $pelanggan->kodepos }}" 
                                data-alamat="{{ $pelanggan->detail_alamat }}">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                            <button class="text-blue-600 hover:text-blue-900 mr-3 openEditModal" data-id="{{ $pelanggan->id }}">Edit</button>
                            <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $pelanggans->links() }}
        </div>
    </div>
</div>
<div id="pelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 bg-white/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
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

<div id="editPelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 bg-gray-900 bg-opacity-50 transition-opacity">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
        <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Edit Pelanggan</h2>
            <button id="closeEditModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    
        <div class="p-6">
            <form id="formEditPelanggan" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" name="nama" id="edit_nama" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="edit_no_handphone" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                    <div class="flex">
                        <input type="tel" name="no_handphone" id="edit_no_handphone" class="flex-grow px-3 py-2 border-t border-r border-b border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="edit_provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="provinsi" id="edit_provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="edit_kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="kota" id="edit_kota" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="edit_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="kecamatan" id="edit_kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label for="edit_kodepos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="kodepos" id="edit_kodepos" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div class="mb-6">
                    <label for="edit_detail_alamat" class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat (Nama Jalan, Gedung, No Rumah)</label>
                    <textarea name="detail_alamat" id="edit_detail_alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" id="cancelEditBtn" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">Kembali</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="detailPelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 bg-gray-900 bg-opacity-50 transition-opacity">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
        <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Detail Pelanggan</h2>
            <button id="closeDetailModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama Pelanggan</p>
                        <p id="detail-nama" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">No. Handphone</p>
                        <p id="detail-phone" class="text-gray-900"></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Provinsi</p>
                        <p id="detail-provinsi" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kota</p>
                        <p id="detail-kota" class="text-gray-900"></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kecamatan</p>
                        <p id="detail-kecamatan" class="text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kode Pos</p>
                        <p id="detail-kodepos" class="text-gray-900"></p>
                    </div>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-gray-500">Detail Alamat</p>
                    <p id="detail-alamat" class="text-gray-900 mt-1 p-2 bg-gray-100 rounded"></p>
                </div>
                
            </div>
            
            <div class="flex justify-end pt-6">
                <button id="closeDetailBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal Detail Pelanggan
    const detailModal = document.getElementById('detailPelangganModal');
    const closeDetailBtn = document.getElementById('closeDetailBtn');
    const closeDetailModalBtn = document.getElementById('closeDetailModal');

    // Open detail modal
    document.querySelectorAll('.detail-pelanggan-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Set data to modal
            document.getElementById('detail-nama').textContent = btn.dataset.nama;
            document.getElementById('detail-phone').textContent = btn.dataset.phone;
            document.getElementById('detail-provinsi').textContent = btn.dataset.provinsi;
            document.getElementById('detail-kota').textContent = btn.dataset.kota;
            document.getElementById('detail-kecamatan').textContent = btn.dataset.kecamatan;
            document.getElementById('detail-kodepos').textContent = btn.dataset.kodepos;
            document.getElementById('detail-alamat').textContent = btn.dataset.alamat;
            
            // Show modal
            detailModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close detail modal
    const closeDetailModal = () => {
        detailModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    closeDetailBtn.addEventListener('click', closeDetailModal);
    closeDetailModalBtn.addEventListener('click', closeDetailModal);

    // Close when clicking outside modal
    window.addEventListener('click', (e) => {
        if (e.target === detailModal) {
            closeDetailModal();
        }
    });

    // Modal functionality for tambah pelanggan
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

    // Modal Edit Pelanggan
    const editModal = document.getElementById('editPelangganModal');
    const closeEditModalBtn = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const formEdit = document.getElementById('formEditPelanggan');

    document.querySelectorAll('.openEditModal').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const pelangganId = e.target.dataset.id;
            fetch(`/kasir/pelanggan/${pelangganId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_nama').value = data.nama;
                    document.getElementById('edit_no_handphone').value = data.no_handphone;
                    document.getElementById('edit_provinsi').value = data.provinsi;
                    document.getElementById('edit_kota').value = data.kota;
                    document.getElementById('edit_kecamatan').value = data.kecamatan;
                    document.getElementById('edit_kodepos').value = data.kodepos;
                    document.getElementById('edit_detail_alamat').value = data.detail_alamat;
                    
                    formEdit.action = `/kasir/pelanggan/${pelangganId}`;
                    editModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
        });
    });

    const closeEditModal = () => {
        editModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    closeEditModalBtn.addEventListener('click', closeEditModal);
    cancelEditBtn.addEventListener('click', closeEditModal);

    window.addEventListener('click', (e) => {
        if (e.target === editModal) {
            closeEditModal();
        }
    });

    // Close when pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !editModal.classList.contains('hidden')) {
            closeEditModal();
        }
    });
</script>

</body>
</html>