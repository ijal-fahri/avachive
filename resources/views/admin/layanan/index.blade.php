<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Layanan - Admin Laundry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; }
        .admin-wrapper { display: flex; height: 100vh; position: relative; overflow-x: hidden; }
        .sidebar { width: 250px; background: #1e272e; color: white; display: flex; flex-direction: column; padding: 1rem; transition: transform 0.3s ease-in-out; z-index: 1000; flex-shrink: 0; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .hamburger-btn { display: none; font-size: 1.8rem; background: none; border: none; cursor: pointer; color: #2f3640; }
        .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
        .produk-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.04); }
        .produk-section h3 { margin-top: 0; font-weight: 600; color: #0984e3; }
        .button-group { display: flex; gap: 10px; margin-bottom: 1rem; flex-wrap: wrap; align-items:center; }
        .tab-button { background: #dfe6e9; border: none; padding: 0.6rem 1.2rem; border-radius: 50px; font-weight: 600; cursor: pointer; transition: background 0.3s ease; }
        .tab-button.active { background: #00cec9; color: white; }
        .add-button { background: #00cec9; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 50px; font-weight: 600; cursor: pointer; transition: background 0.3s ease; display:flex; align-items:center; gap:8px; }
        .add-button:hover { background: #01a3a4; }
        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle; }
        th { background-color: #f1f2f6; color: #2f3640; }
        .aksi-buttons { display: flex; gap: 5px; }
        .aksi-buttons button { padding: 0.4rem 0.8rem; border: none; border-radius: 6px; cursor: pointer; font-size: 0.85rem; }
        .btn-edit { background: #00a8ff; color: white; }
        .btn-delete { background: #e84118; color: white; }
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; padding: 1rem; }
        .modal-content { background: #fff; padding: 1.5rem; border-radius: 12px; width: 100%; max-width: 520px; position: relative; animation: fadeIn 0.25s ease-in-out; box-shadow: 0 8px 30px rgba(0,0,0,0.08); }
        .close { position: absolute; right: 1rem; top: 1rem; font-size: 1.3rem; cursor: pointer; }
        .modal-content h4 { margin-top: 0; }
        .modal-content input, .modal-content select { width: 100%; padding: 0.6rem; margin-top: 0.5rem; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; }
        .modal-content button { background: #00cec9; color: #fff; padding: 0.6rem 1.2rem; border: none; border-radius: 8px; cursor: pointer; margin-top: 1rem; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: 0; top: 0; height: 100%; transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .hamburger-btn { display: block; }
            table thead { display: none; }
            table tr { display: block; margin-bottom: 1rem; border: 1px solid #ddd; border-radius: 8px; padding: 0.5rem; }
            table td { display: block; text-align: right; font-size: 0.85rem; border-bottom: 1px solid #eee; padding: 0.5rem 0; }
            table td::before { content: attr(data-label); float: left; font-weight: bold; }
            table td:last-child { border-bottom: 0; }
            .main-content { padding: 1rem; }
            .produk-section { padding: 1rem; }
            
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    <aside class="sidebar" id="sidebar">
        <h2>Avachive</h2>
        <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ route('produk.index') }}" class="active"><i class="bi bi-list-check"></i> Layanan</a>
        <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
        <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
        <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <main class="main-content">
       <div class="topbar">
                <button class="hamburger-btn" id="hamburgerBtn"><i class="bi bi-list"></i></button>
                <div>Data Layanan</div>
                <div class="user-info">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                </div>
            </div>
        <section class="produk-section">
            <h3>Daftar Layanan</h3>
            <div class="button-group">
                <button class="tab-button" data-tab="Kiloan">Kiloan</button>
                <button class="tab-button" data-tab="Satuan">Satuan</button>
                <button id="openTambahBtn" class="add-button"><i class="bi bi-plus-circle"></i> Tambah Layanan</button>
            </div>

            <div class="table-wrap">
                <table id="layananTable">
                    <thead>
                        <tr>
                            <th style="width:60px">No</th>
                            <th>Nama Layanan</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="layananTbody">
                        @forelse($layanans as $layanan)
                            <tr data-kategori="{{ $layanan->kategori }}" data-id="{{ $layanan->id }}">
                                <td data-label="No"></td>
                                <td data-label="Nama Layanan" class="cell-nama">{{ $layanan->nama }}</td>
                                <td data-label="Paket" class="cell-paket">{{ $layanan->paket }}</td>
                                <td data-label="Harga" class="cell-harga">Rp {{ number_format($layanan->harga, 0, ',', '.') }} / {{ $layanan->kategori == 'Kiloan' ? 'Kg' : 'Pcs' }}</td>
                                <td data-label="Aksi">
                                    <div class="aksi-buttons">
                                        <button class="btn-edit" data-id="{{ $layanan->id }}" data-json='@json($layanan)'><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn-delete" data-id="{{ $layanan->id }}"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row"><td colspan="5" style="text-align: center;">Belum ada data layanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<div class="overlay" id="overlay"></div>

<div id="tambahModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeTambah">&times;</span>
        <h4>Tambah Layanan</h4>
        <form id="tambahForm" action="{{ route('produk.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kategori" id="kategoriInput">
            <label>Nama Layanan</label>
            <input type="text" name="nama" required />
            <label>Paket</label>
            <select name="paket" required>
                <option value="Standar">Standar</option>
                <option value="Express">Express</option>
            </select>
            <label>Harga</label>
            <input type="number" name="harga" required />
            <div style="display:flex;gap:8px;justify-content:flex-end">
                <button type="button" id="batalTambah" style="background:#ccc;color:#222;">Batal</button>
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeEdit">&times;</span>
        <h4>Edit Layanan</h4>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId" />
            <label>Nama Layanan</label>
            <input type="text" name="nama" id="editNama" required />
            <label>Paket</label>
            <select name="paket" id="editPaket" required>
                <option value="Standar">Standar</option>
                <option value="Express">Express</option>
            </select>
            <label>Kategori</label>
            <select name="kategori" id="editKategori" required>
                <option value="Kiloan">Kiloan</option>
                <option value="Satuan">Satuan</option>
            </select>
            <label>Harga</label>
            <input type="number" name="harga" id="editHarga" required />
            <div style="display:flex;gap:8px;justify-content:flex-end">
                <button type="button" id="batalEdit" style="background:#ccc;color:#222;">Batal</button>
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Helper dan Elemen
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const tabButtons = document.querySelectorAll('.tab-button');
    const tbody = document.getElementById('layananTbody');
    const tambahModal = document.getElementById('tambahModal');
    const editModal = document.getElementById('editModal');
    const openTambahBtn = document.getElementById('openTambahBtn');
    const kategoriInput = document.getElementById('kategoriInput');
    const tambahForm = document.getElementById('tambahForm');
    const editForm = document.getElementById('editForm');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    let activeTab = localStorage.getItem('activeLayananTab') || 'Kiloan';
    // --- FUNGSI-FUNGSI ---
    // Fungsi untuk memfilter dan menomori ulang baris tabel
    function filterAndRenumberRows() {
        let visibleCount = 0;
        const rows = tbody.querySelectorAll('tr[data-kategori]');
        rows.forEach(row => {
            if (row.dataset.kategori === activeTab) {
                row.style.display = '';
                visibleCount++;
                const noCell = row.querySelector('td[data-label="No"]');
                if(noCell) noCell.textContent = visibleCount;
            } else {
                row.style.display = 'none';
            }
        });
        // Hapus pesan "kosong" jika ada baris yang terlihat
        const emptyRow = tbody.querySelector('.empty-row');
        if (visibleCount > 0 && emptyRow) {
            emptyRow.remove();
        } else if (visibleCount === 0 && !emptyRow) {
            const tr = document.createElement('tr');
            tr.classList.add('empty-row');
            tr.innerHTML = `<td colspan="5" style="text-align:center;">Belum ada layanan di kategori ini.</td>`;
            tbody.appendChild(tr);
        }
    }
    // Fungsi untuk mengatur tab aktif
    function setActiveTab(tabName) {
        activeTab = tabName;
        localStorage.setItem('activeLayananTab', tabName);
        tabButtons.forEach(b => b.classList.remove('active'));
        const currentTabButton = document.querySelector(`.tab-button[data-tab="${tabName}"]`);
        if (currentTabButton) currentTabButton.classList.add('active');
        filterAndRenumberRows();
    }
    function openModal(modal) { modal.style.display = 'flex'; }
    function closeModal(modal) { modal.style.display = 'none'; }
    // Fungsi untuk membuka sidebar (hamburger)
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    }
    // --- EVENT LISTENERS ---
    // Tombol Tab
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => setActiveTab(btn.dataset.tab));
    });
    // Tombol "Tambah Layanan"
    openTambahBtn.addEventListener('click', () => {
        tambahForm.reset();
        kategoriInput.value = activeTab;
        openModal(tambahModal);
    });
    // Event Delegation untuk tombol Edit dan Delete di dalam tabel
    tbody.addEventListener('click', (e) => {
        const editBtn = e.target.closest('.btn-edit');
        const deleteBtn = e.target.closest('.btn-delete');
        if (editBtn) {
            const data = JSON.parse(editBtn.dataset.json);
            let actionUrl = "{{ route('produk.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', data.id);
            editForm.action = actionUrl;
            document.getElementById('editNama').value = data.nama;
            document.getElementById('editPaket').value = data.paket;
            document.getElementById('editKategori').value = data.kategori;
            document.getElementById('editHarga').value = data.harga;
            openModal(editModal);
        }
        if (deleteBtn) {
            const id = deleteBtn.dataset.id;
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('produk') }}/${id}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    });
    // Event listener untuk tombol close dan batal di modal
    document.querySelectorAll('.close, #batalTambah, #batalEdit').forEach(btn => {
        btn.addEventListener('click', () => closeModal(btn.closest('.modal')));
    });
    // Notifikasi sukses dari session Laravel
    @if (session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif
    
    // Hamburger Menu
    hamburgerBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);
    // Inisialisasi halaman saat pertama kali dimuat
    setActiveTab(activeTab);
});
</script>
</body>
</html>