<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Laundry - Avachive</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #00cec9;
            --secondary-color: #0984e3;
            --dark-color: #1e272e;
            --light-gray: #f4f7fc;
            --text-color: #333;
            --border-color: #dfe6e9;
            --danger-color: #e84118;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: var(--light-gray); color: var(--text-color); }
        .admin-wrapper { display: flex; height: 100vh; position: relative; overflow-x: hidden; }
        .sidebar { width: 250px; background: var(--dark-color); color: white; display: flex; flex-direction: column; padding: 1rem; transition: transform 0.3s ease-in-out; z-index: 1000; flex-shrink: 0; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: var(--primary-color); }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: var(--primary-color); color: #fff; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; transition: padding 0.3s ease; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; transition: all 0.3s ease; }
        .hamburger-btn { display: none; font-size: 1.8rem; background: none; border: none; cursor: pointer; color: #2f3640; line-height: 1; }
        .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999; }
        .cabang-container { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .cabang-container label { font-weight: 600; font-size: 14px; color: var(--text-color); }
        .cabang-select { appearance: none; -webkit-appearance: none; -moz-appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 16px 12px; padding: 8px 32px 8px 14px; border: 1px solid var(--border-color); border-radius: 8px; background-color: #fff; font-size: 14px; cursor: pointer; outline: none; transition: all 0.2s ease; }
        .cabang-select:hover { border-color: var(--secondary-color); }
        .cabang-select:focus { border-color: var(--secondary-color); box-shadow: 0 0 0 3px rgba(9, 132, 227, 0.2); }
        .user-info { display: flex; align-items: center; gap: 6px; font-size: 14px; color: var(--text-color); }
        .dashboard-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05); margin-bottom: 2rem; transition: all 0.3s ease; }
        .dashboard-section:hover { box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07); }
        .dashboard-section h3 { margin-top: 0; font-weight: 600; color: var(--secondary-color); }
        .stat-box { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.2rem; }
        .stat-card { background: #fff; padding: 1.2rem; border-radius: 20px; border: 5px solid #f0f0f0; display: flex; flex-direction: column; gap: 0.5rem; text-align: center; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); }
        .stat-card h4 { margin: 0; font-size: 1rem; font-weight: 500; color: #636e72; }
        .stat-card p { font-size: 1.4rem; font-weight: 700; color: var(--secondary-color); margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; font-size: 0.9rem; }
        th, td { padding: 0.85rem; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; color: #2f3640; font-weight: 600; }
        tr:hover td { background: #f9fafb; }
        td div { margin-bottom: 3px; }
        footer { text-align: center; padding: 1rem; font-size: 0.85rem; color: #888; margin-top: 2rem; }
        .modal { display: none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); justify-content: center; align-items: center; padding: 1rem; }
        .modal-content { background: #fff; padding: 2rem; border-radius: 12px; width: 100%; max-width: 400px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2); position: relative; animation: slideInFade 0.4s ease-out forwards; }
        @keyframes slideInFade { from { opacity: 0; transform: translateY(-20px) scale(0.98); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .modal-content h2 { margin-top: 0; margin-bottom: 1.5rem; font-size: 1.5rem; color: var(--dark-color); border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #555; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px 12px; border-radius: 8px; border: 1px solid var(--border-color); background-color: #f8f9fa; transition: border-color 0.3s ease, box-shadow 0.3s ease; }
        .form-group input:focus, .form-group textarea:focus { background-color: #fff; border-color: var(--secondary-color); box-shadow: 0 0 0 3px rgba(9, 132, 227, 0.2); outline: none; }
        .btn-submit { width: 100%; padding: 12px; margin-top: 1rem; background: var(--secondary-color); color: white; font-weight: 600; font-size: 1rem; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s, transform 0.2s; }
        .btn-submit:hover { background: #0773c5; transform: translateY(-2px); }
        .close-btn { position: absolute; right: 15px; top: 15px; font-size: 1.5rem; cursor: pointer; color: #888; width: 30px; height: 30px; line-height: 30px; text-align: center; border-radius: 50%; transition: background-color 0.2s ease, color 0.2s ease; }
        .close-btn:hover { background-color: #f1f1f1; color: #111; }
        .btn-tambah, .btn-detail, .btn-edit, .btn-hapus { padding: 8px 14px; border: none; font-size: 13px; font-weight: 600; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.25s ease; box-shadow: 0 3px 6px rgba(0,0,0,0.08); }
        .btn-tambah { background: var(--secondary-color); color: #fff; }
        .btn-tambah:hover { background: #0773c5; transform: translateY(-2px); box-shadow: 0 5px 10px rgba(0,0,0,0.12); }
        .btn-detail { background: var(--primary-color); color: #fff; }
        .btn-detail:hover { background: #00b5b0; transform: translateY(-2px); box-shadow: 0 5px 10px rgba(0,0,0,0.12); }
        .btn-edit { background: #ff9800; color: #fff; }
        .btn-edit:hover { background: #e68900; transform: translateY(-2px); box-shadow: 0 5px 10px rgba(0,0,0,0.12); }
        .btn-hapus { background: var(--danger-color); color: #fff; }
        .btn-hapus:hover { background: #c23616; transform: translateY(-2px); box-shadow: 0 5px 10px rgba(0,0,0,0.12); }
        .modal-actions { display: flex; gap: 10px; margin-top: 1rem; }
        .modal-actions > * { flex: 1; margin-top: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-on-load { opacity: 0; animation-name: fadeInUp; animation-duration: 0.6s; animation-timing-function: ease-out; animation-fill-mode: forwards; }
        .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; } .delay-3 { animation-delay: 0.3s; } .delay-4 { animation-delay: 0.4s; } .delay-5 { animation-delay: 0.5s; } .delay-6 { animation-delay: 0.6s; } .delay-7 { animation-delay: 0.7s; }
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: 0; top: 0; height: 100%; transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .hamburger-btn { display: block; }
            .main-content { padding: 1rem; }
            .topbar { padding: 1rem; gap: 0.75rem; }
            .dashboard-section { padding: 1.5rem 1rem; }
            .dashboard-section h3 { font-size: 1.2rem; }
            table { border: 0; }
            table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px; }
            table tr { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); display: block; margin-bottom: 1rem; border-bottom: none; }
            table td { border-bottom: 1px solid #f0f0f0; display: block; font-size: 0.9em; padding: 0.8rem 1rem; text-align: right; }
            table td::before { content: attr(data-label); float: left; font-weight: 600; color: #555; text-transform: uppercase; font-size: 0.8em; }
            table td:last-child { border-bottom: 0; }
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    <aside class="sidebar" id="sidebar">
        <h2>Avachive</h2>
        <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
        <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
        <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
        <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <main class="main-content">
        <div class="topbar animate-on-load delay-1">
            <button class="hamburger-btn" id="hamburgerBtn"><i class="bi bi-list"></i></button>
            <div class="cabang-container">
                <label for="cabangSelect">🏬 Cabang:</label>
                <select id="cabangSelect" class="cabang-select">
                    @if($semuaCabang->isEmpty())
                        <option>Belum ada cabang</option>
                    @else
                        @foreach($semuaCabang as $cabang)
                            <option value="{{ $cabang->id }}" {{ $cabang->id == $cabangTerpilihId ? 'selected' : '' }}>
                                {{ $cabang->nama_cabang }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <button class="btn-tambah" id="btnTambahCabang"><i class="bi bi-plus-lg"></i> Tambah Cabang</button>
                <button class="btn-detail" id="btnDetailCabang"><i class="bi bi-info-circle"></i> Detail Alamat</button>
                <button class="btn-edit" id="btnEditCabang"><i class="bi bi-pencil-square"></i> Edit Cabang</button>
            </div>
            <div class="user-info">
                <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
            </div>
        </div>

        <section class="dashboard-section animate-on-load delay-2">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.4rem; font-weight: 600; color: #2d3436;">📊 Ringkasan Data</h3>
            <div class="stat-box">
                <div class="stat-card"><h4>Pendapatan Tahun Ini</h4><p>Rp {{ number_format($pendapatan_tahun_ini, 0, ',', '.') }}</p></div>
                <div class="stat-card"><h4>Pendapatan Bulan Ini</h4><p>Rp {{ number_format($pendapatan_bulan_ini, 0, ',', '.') }}</p></div>
                <div class="stat-card"><h4>Total Order Tahun Ini</h4><p>{{ number_format($total_order_tahun_ini, 0, ',', '.') }}</p></div>
                <div class="stat-card"><h4>Total Order Bulan Ini</h4><p>{{ number_format($total_order_bulan_ini, 0, ',', '.') }}</p></div>
                <div class="stat-card"><h4>Jumlah Pelanggan</h4><p>{{ number_format($jumlah_pelanggan, 0, ',', '.') }}</p></div>
                <div class="stat-card"><h4>Jumlah Layanan</h4><p>{{ $jumlah_layanan }}</p></div>
                <div class="stat-card"><h4>Order Selesai</h4><p>{{ $order_selesai }}</p></div>
                <div class="stat-card"><h4>Total Cabang</h4><p>{{ $semuaCabang->count() }}</p></div>
            </div>
        </section>
        
        <section class="dashboard-section animate-on-load delay-4" style="background: linear-gradient(135deg, #00cec9, #0984e3); color: white; padding: 2rem; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.08);">
    <h3 style="color: #fff; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
        <i class="bi bi-geo-alt-fill"></i> Info Cabang
    </h3>
    <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
        <div style="flex: 1; min-width: 250px; background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 12px; backdrop-filter: blur(5px);">
            <p style="margin: 0; font-size: 0.9rem; opacity: 0.9;">Cabang Pemasukan Tertinggi</p>
            <h4 style="margin: 0.2rem 0 0; font-weight: 600; font-size: 1.2rem; display: flex; align-items: center; gap: 6px;">
                <i class="bi bi-trophy-fill"></i> 
                {{-- Data Dinamis --}}
                {{ $cabangTop->nama_cabang ?? 'Belum ada data' }}
            </h4>
        </div>
        <div style="flex: 1; min-width: 250px; background: rgba(255,255,255,0.1); padding: 1rem; border-radius: 12px; backdrop-filter: blur(5px);">
            <p style="margin: 0; font-size: 0.9rem; opacity: 0.9;">Layanan Favorit di Cabang Ini</p>
            <h4 style="margin: 0.2rem 0 0; font-weight: 600; font-size: 1.2rem; display: flex; align-items: center; gap: 6px;">
                <i class="bi bi-star-fill"></i> 
                {{-- Data Dinamis --}}
                {{ $layananFavorit }}
            </h4>
        </div>
    </div>
</section>

        <section class="dashboard-section animate-on-load delay-4">
            <h3><i class="bi bi-bar-chart-line-fill"></i> Statistik Pesanan Tahun {{ now()->year }}</h3>
            <div style="height: 250px;"><canvas id="orderChart"></canvas></div>
        </section>

        <section class="dashboard-section animate-on-load delay-5">
            <h3>Data Pesanan Hari Ini ({{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }})</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Order</th><th>Nama</th><th>Layanan</th><th>Total</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanan_hari_ini as $order)
                    <tr>
                        <td data-label="ID Order">#{{ $order->id }}</td>
                        <td data-label="Nama">{{ $order->pelanggan->nama ?? 'N/A' }}</td>
                        <td data-label="Layanan">
                            @php $layanan_items = json_decode($order->layanan, true) ?? []; @endphp
                            @foreach($layanan_items as $item)
                            <div>{{ $item['nama'] ?? '' }} ({{ $item['kuantitas'] ?? '' }}x)</div>
                            @endforeach
                        </td>
                        <td data-label="Total">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td data-label="Status">{{ $order->status ?? 'Baru' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align: center;">Tidak ada pesanan hari ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <footer class="animate-on-load delay-6">
            © {{ date('Y') }} Admin Laundry. All rights reserved.
        </footer>
    </main>
</div>

<div class="overlay" id="overlay"></div>

<!-- Modal Tambah Cabang -->
<div class="modal" id="modalTambahCabang">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah Cabang Baru</h2>
        <form id="formTambahCabang" method="POST" action="{{ route('cabang.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama_cabang_add">Nama Cabang</label>
                <input id="nama_cabang_add" name="nama_cabang" type="text" placeholder="Masukkan nama cabang" required>
            </div>
            <div class="form-group">
                <label for="alamat_add">Alamat Lengkap Cabang</label>
                <input id="alamat_add" name="alamat" type="text" placeholder="Masukkan alamat lengkap" required>
            </div>
            <small style="display:block; margin-top:5px; color:gray;">*Tolong isi sesuai alamat lengkap</small>
            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal Detail Cabang -->
<div class="modal" id="modalDetailCabang">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="detailNamaCabangTitle">Detail Cabang</h2>
        <div class="form-group">
            <label>Nama Cabang</label>
            <p id="detailNamaCabang" style="margin:0; font-weight:bold;">Memuat...</p>
        </div>
        <div class="form-group">
            <label>Alamat Lengkap</label>
            <p id="detailAlamatCabang" style="margin:0;">Memuat...</p>
        </div>
        <div class="form-group">
            <a id="btnLihatMaps" href="#" target="_blank" class="btn-submit" 
               style="display:none; text-decoration:none; text-align:center; background:#34A853;">
                <i class="bi bi-geo-alt"></i> Lihat di Google Maps
            </a>
        </div>
    </div>
</div>

<!-- Modal Edit Cabang -->
<div class="modal" id="modalEditCabang">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2 id="editNamaCabangTitle">Edit Cabang</h2>
        <form id="formEditCabang" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_cabang_edit">Nama Cabang</label>
                <input id="nama_cabang_edit" name="nama_cabang" type="text" required>
            </div>
            <div class="form-group">
                <label for="alamat_edit">Alamat Lengkap Cabang</label>
                <input id="alamat_edit" name="alamat" type="text" required>
            </div>
            <small style="display:block; margin-top:5px; color:gray;">*Tolong ubah sesuai alamat lengkap</small>
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
        <hr>
        <button id="btnDeleteFromEdit" class="btn" 
                style="background:#dc3545; color:white; border:none; padding:10px; width:100%; border-radius:5px; cursor:pointer; margin-top:10px;">
            <i class="bi bi-trash"></i> Hapus Cabang
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENTS ---
    const cabangSelect = document.getElementById('cabangSelect');
    const modals = {
        tambah: document.getElementById('modalTambahCabang'),
        detail: document.getElementById('modalDetailCabang'),
        edit: document.getElementById('modalEditCabang'),
    };

    // --- MODAL HANDLER ---
    const openModal = (modal) => { if(modal) modal.style.display = 'flex'; };
    const closeModal = (modal) => { if(modal) modal.style.display = 'none'; };
    document.querySelectorAll('.modal .close-btn').forEach(btn => {
        btn.addEventListener('click', () => closeModal(btn.closest('.modal')));
    });
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal')) closeModal(e.target);
    });

    // --- API / DATA ---
    const getSelectedCabangId = () => {
        const id = cabangSelect?.value;
        if (!id || isNaN(id)) {
            Swal.fire('Informasi', 'Silakan pilih cabang terlebih dahulu atau buat cabang baru.', 'info');
            return null;
        }
        return id;
    };
    const fetchCabangData = async (id) => {
        try {
            const response = await fetch(`/admin/cabang/${id}`);
            if (!response.ok) throw new Error('Gagal ambil data');
            return await response.json();
        } catch (error) {
            Swal.fire('Error', 'Gagal mengambil data cabang.', 'error');
            return null;
        }
    };

    // --- EVENT LISTENERS ---
    // Modal Tambah
    document.getElementById('btnTambahCabang')?.addEventListener('click', () => {
        modals.tambah.querySelector('form').reset();
        openModal(modals.tambah);
    });

    // Modal Detail
    document.getElementById('btnDetailCabang')?.addEventListener('click', async () => {
        const id = getSelectedCabangId();
        if (!id) return;
        const data = await fetchCabangData(id);
        if (data) {
            document.getElementById('detailNamaCabangTitle').innerText = `Detail: ${data.nama_cabang}`;
            document.getElementById('detailNamaCabang').innerText = data.nama_cabang;
            
            const alamatEl = document.getElementById('detailAlamatCabang');
            const btnMaps = document.getElementById('btnLihatMaps');
            if (data.alamat) {
                alamatEl.innerHTML = `<a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.alamat)}"
                                       target="_blank"
                                       style="color: var(--primary-color); text-decoration: underline;">${data.alamat}</a>`;
                btnMaps.href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.alamat)}`;
                btnMaps.style.display = 'inline-block';
            } else {
                alamatEl.innerText = 'Tidak ada alamat.';
                btnMaps.style.display = 'none';
            }

            openModal(modals.detail);
        }
    });

    // Modal Edit
    document.getElementById('btnEditCabang')?.addEventListener('click', async () => {
        const id = getSelectedCabangId();
        if (!id) return;
        const data = await fetchCabangData(id);
        if (data) {
            const form = document.getElementById('formEditCabang');
            form.action = `/admin/cabang/${data.id}`;
            document.getElementById('editNamaCabangTitle').innerText = `Edit: ${data.nama_cabang}`;
            document.getElementById('nama_cabang_edit').value = data.nama_cabang;
            document.getElementById('alamat_edit').value = data.alamat;

            const btnDelete = document.getElementById('btnDeleteFromEdit');
            btnDelete.dataset.id = data.id;
            btnDelete.dataset.name = data.nama_cabang;

            openModal(modals.edit);
        }
    });

    // Tombol Hapus
    document.getElementById('btnDeleteFromEdit')?.addEventListener('click', function() {
        const id = this.dataset.id;
        const name = this.dataset.name;
        if (!id) return;

        Swal.fire({
            title: `Hapus Cabang "${name}"?`,
            text: "Anda yakin? Tindakan ini tidak bisa dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--danger-color)',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteForm = document.createElement('form');
                deleteForm.method = 'POST';
                deleteForm.action = `/admin/cabang/${id}`;
                deleteForm.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(deleteForm);
                deleteForm.submit();
            }
        });
    });

    // Ganti Cabang Aktif
    cabangSelect?.addEventListener('change', function() {
        if (this.value && !isNaN(this.value)) {
            window.location.href = `{{ url('admin/set-cabang') }}/${this.value}`;
        }
    });

    // --- NOTIFIKASI ---
    @if (session('success'))
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', text: '{{ session('success') }}', showConfirmButton: false, timer: 3000 });
    @endif
    @if ($errors->any())
        Swal.fire({ icon: 'error', title: 'Oops...', text: '{{ $errors->first() }}' });
    @endif

    // --- SIDEBAR ---
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    function toggleSidebar() {
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    }
    hamburgerBtn?.addEventListener('click', toggleSidebar);
    overlay?.addEventListener('click', toggleSidebar);

    // --- CHART ---
    if (document.getElementById('orderChart')) {
        const labels = @json($chart_labels ?? []);
        const data = @json($chart_data ?? []);
        new Chart(document.getElementById('orderChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Order',
                    backgroundColor: 'rgba(9, 132, 227, 0.2)',
                    borderColor: 'rgba(9, 132, 227, 1)',
                    data: data,
                    fill: true,
                    borderWidth: 2,
                    tension: 0.4,
                    pointBackgroundColor: '#0984e3',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });
    }
});
</script>

</body>
</html>
