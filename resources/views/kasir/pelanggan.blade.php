<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Daftar Pelanggan</title>
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .modal-content { max-height: 80vh; overflow-y: auto; }
        
        /* DITAMBAHKAN: Style untuk latar belakang modal blur */
        .modal-backdrop {
            background-color: rgba(17, 24, 39, 0.5); /* bg-gray-900/50 */
            -webkit-backdrop-filter: blur(4px); /* backdrop-blur-sm */
            backdrop-filter: blur(4px);
        }

        @media (max-width: 768px) {
            .responsive-table thead { display: none; }
            .responsive-table tr { display: block; margin-bottom: 1rem; border: 1px solid #ddd; border-radius: 5px; padding: 0.5rem; }
            .responsive-table td { display: block; text-align: right; padding-left: 50%; position: relative; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; padding-top: 0.5rem; white-space: normal; }
            .responsive-table td::before { content: attr(data-label); position: absolute; left: 6px; width: 45%; padding-right: 10px; text-align: left; font-weight: bold; }
            .responsive-table td:last-child { border-bottom: none; }
            .aksi-buttons-responsive { justify-content: flex-end; }
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

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
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
                    @forelse ($pelanggans as $pelanggan)
                    <tr class="hover:bg-gray-50">
                        <td data-label="No" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($pelanggans->currentPage() - 1) * $pelanggans->perPage() + $loop->iteration }}</td>
                        <td data-label="Nama Pelanggan" class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-medium">{{ substr($pelanggan->nama, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pelanggan->nama }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Nomor Telepon" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelanggan->no_handphone }}</td>
                        <td data-label="Alamat" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pelanggan->kecamatan }}</td>
                        <td data-label="Aksi" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2 aksi-buttons-responsive">
                                <button class="text-blue-600 hover:text-blue-800 px-3 py-1 border border-blue-100 rounded-lg text-sm detail-btn bg-blue-50 hover:bg-blue-100 transition-colors" 
                                    data-nama="{{ $pelanggan->nama }}" data-phone="{{ $pelanggan->no_handphone }}" data-provinsi="{{ $pelanggan->provinsi }}" 
                                    data-kota="{{ $pelanggan->kota }}" data-kecamatan="{{ $pelanggan->kecamatan }}" data-kodepos="{{ $pelanggan->kodepos }}" 
                                    data-alamat="{{ $pelanggan->detail_alamat }}">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-800 px-3 py-1 border border-yellow-100 rounded-lg text-sm openEditModal bg-yellow-50 hover:bg-yellow-100 transition-colors" data-id="{{ $pelanggan->id }}">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-1 border border-red-100 rounded-lg text-sm bg-red-50 hover:bg-red-100 transition-colors">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Tidak ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-white px-4 py-3 border-t border-gray-200">
            {{ $pelanggans->links() }}
        </div>
    </div>
</div>

<div id="pelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 modal-backdrop"></div>
<div id="editPelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 modal-backdrop"></div>
<div id="detailPelangganModal" class="hidden fixed inset-0 z-50 flex items-start justify-center pt-10 modal-backdrop"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- SEMUA ELEMEN ---
    const detailModal = document.getElementById('detailPelangganModal');
    const addEditModal = document.getElementById('pelangganModal'); // Satu modal untuk tambah/edit
    const openBtn = document.getElementById('openModal');

    // --- FUNGSI-FUNGSI ---
    const closeModal = () => {
        detailModal.classList.add('hidden');
        addEditModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Open detail modal
    document.querySelectorAll('.detail-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const detailHtml = `
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
                    <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Detail Pelanggan</h2>
                        <button class="text-gray-500 hover:text-gray-700 close-modal-btn"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div><p class="text-sm font-medium text-gray-500">Nama</p><p class="text-gray-900">${btn.dataset.nama}</p></div>
                                <div><p class="text-sm font-medium text-gray-500">No. HP</p><p class="text-gray-900">${btn.dataset.phone}</p></div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><p class="text-sm font-medium text-gray-500">Provinsi</p><p class="text-gray-900">${btn.dataset.provinsi}</p></div>
                                <div><p class="text-sm font-medium text-gray-500">Kota</p><p class="text-gray-900">${btn.dataset.kota}</p></div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><p class="text-sm font-medium text-gray-500">Kecamatan</p><p class="text-gray-900">${btn.dataset.kecamatan}</p></div>
                                <div><p class="text-sm font-medium text-gray-500">Kode Pos</p><p class="text-gray-900">${btn.dataset.kodepos}</p></div>
                            </div>
                            <div><p class="text-sm font-medium text-gray-500">Alamat Lengkap</p><p class="text-gray-900 mt-1 p-2 bg-gray-100 rounded">${btn.dataset.alamat}</p></div>
                        </div>
                        <div class="flex justify-end pt-6">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition close-modal-btn">Tutup</button>
                        </div>
                    </div>
                </div>`;
            detailModal.innerHTML = detailHtml;
            detailModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            detailModal.querySelector('.close-modal-btn').addEventListener('click', closeModal);
        });
    });

    // Open modal tambah
    openBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const addFormHtml = `
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
                <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Pelanggan</h2>
                    <button class="text-gray-500 hover:text-gray-700 close-modal-btn"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <form action="{{ route('pelanggan.store') }}" method="POST">
                        @csrf
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Nama</label><input type="text" name="nama" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label><input type="tel" name="no_handphone" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label><input type="text" name="provinsi" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kota</label><input type="text" name="kota" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label><input type="text" name="kecamatan" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label><input type="text" name="kodepos" class="w-full px-3 py-2 border rounded-md" required></div>
                        <div class="mb-6"><label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label><textarea name="detail_alamat" rows="3" class="w-full px-3 py-2 border rounded-md" required></textarea></div>
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" class="px-4 py-2 border rounded-md close-modal-btn">Kembali</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>`;
        addEditModal.innerHTML = addFormHtml;
        addEditModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        addEditModal.querySelector('.close-modal-btn').addEventListener('click', closeModal);
    });
    
    // Open modal edit
    document.querySelectorAll('.openEditModal').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const pelangganId = e.currentTarget.dataset.id;
            fetch(`/kasir/pelanggan/${pelangganId}/edit`)
                .then(response => response.json())
                .then(data => {
                    const editFormHtml = `
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 modal-content">
                            <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
                                <h2 class="text-xl font-semibold text-gray-800">Edit Pelanggan</h2>
                                <button class="text-gray-500 hover:text-gray-700 close-modal-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="p-6">
                                <form action="/kasir/pelanggan/${pelangganId}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Nama</label><input type="text" name="nama" class="w-full px-3 py-2 border rounded-md" value="${data.nama}" required></div>
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label><input type="tel" name="no_handphone" class="w-full px-3 py-2 border rounded-md" value="${data.no_handphone}" required></div>
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label><input type="text" name="provinsi" class="w-full px-3 py-2 border rounded-md" value="${data.provinsi}" required></div>
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kota</label><input type="text" name="kota" class="w-full px-3 py-2 border rounded-md" value="${data.kota}" required></div>
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label><input type="text" name="kecamatan" class="w-full px-3 py-2 border rounded-md" value="${data.kecamatan}" required></div>
                                    <div class="mb-4"><label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label><input type="text" name="kodepos" class="w-full px-3 py-2 border rounded-md" value="${data.kodepos}" required></div>
                                    <div class="mb-6"><label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label><textarea name="detail_alamat" rows="3" class="w-full px-3 py-2 border rounded-md" required>${data.detail_alamat}</textarea></div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" class="px-4 py-2 border rounded-md close-modal-btn">Kembali</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>`;
                    addEditModal.innerHTML = editFormHtml;
                    addEditModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    addEditModal.querySelector('.close-modal-btn').addEventListener('click', closeModal);
                });
        });
    });

    // Menutup modal saat klik di luar area
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('fixed')) {
            closeModal();
        }
    });

    // SweetAlert untuk notifikasi sukses
    @if(session('success'))
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: '{{ session('success') }}', showConfirmButton: false, timer: 3000 });
    @endif
    
    // SweetAlert untuk konfirmasi hapus
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Anda yakin?', text: "Data pelanggan ini akan dihapus!", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { this.submit(); }
            });
        });
    });

});
</script>

</body>
</html>