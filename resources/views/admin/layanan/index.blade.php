<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Layanan - Admin Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; } 
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; } 
        .admin-wrapper { display: flex; height: 100vh; overflow: hidden; } 
        .sidebar { width: 250px; background: #1e272e; color: white; display: flex; flex-direction: column; padding: 1rem; } 
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; } 
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; } 
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; } 
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; } 
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; } 
        .topbar .user-info { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; } 
        .produk-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.04); animation: fadeIn 0.4s ease-in-out; } 
        .produk-section h3 { margin-top: 0; font-weight: 600; color: #0984e3; } 
        .add-button { background: #00cec9; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; margin-bottom: 1rem; transition: background 0.3s ease; } 
        .add-button:hover { background: #01a3a4; } 
        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; } 
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eee; } 
        th { background-color: #f1f2f6; color: #2f3640; } 
        tr:hover { background-color: #f9fbff; } 
        .aksi-buttons { display: flex; gap: 5px; } 
        .aksi-buttons button { padding: 0.4rem 0.8rem; border: none; border-radius: 6px; cursor: pointer; font-size: 0.85rem; } 
        .btn-edit { background: #00a8ff; color: white; } 
        .btn-delete { background: #e84118; color: white; } 
        .modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; } 
        .modal-content { background: #fff; padding: 2rem; border-radius: 12px; width: 90%; max-width: 500px; position: relative; animation: fadeIn 0.3s ease-in-out; } 
        .close { position: absolute; right: 1rem; top: 1rem; font-size: 1.5rem; cursor: pointer; line-height: 1; } 
        .modal-content h4 { margin-top: 0; } 
        .modal-content input, .modal-content select { width: 100%; padding: 0.6rem; margin-top: 0.5rem; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; font-family: 'Poppins', sans-serif; } 
        .modal-content button { background: #00cec9; color: #fff; padding: 0.6rem 1.2rem; border: none; border-radius: 8px; cursor: pointer; margin-top: 1rem; } 
        @media (max-width: 768px) { .admin-wrapper { flex-direction: column; } .sidebar { flex-direction: row; overflow-x: auto; width: 100%; padding: 0.5rem; } .sidebar a { flex: 1; justify-content: center; font-size: 0.9rem; } } 
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Avachive</h2>
            <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk.index') }}" class="active"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>
        <main class="main-content fade-in">
            <div class="topbar fade-in">
                <div>Data Layanan Laundry</div>
                <div class="user-info">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                </div>
            </div>
            <section class="produk-section">
                <h3>Daftar Layanan</h3>
                <button class="add-button" onclick="openModal('tambahModal')"><i class="bi bi-plus-circle"></i> Tambah Layanan</button>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th>Paket</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layanans as $layanan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $layanan->nama }}</td>
                            <td>{{ $layanan->paket }}</td>
                            <td>{{ $layanan->kategori }}</td>
                            <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }} / {{ $layanan->kategori == 'Kiloan' ? 'Kg' : 'Pcs' }}</td>
                            <td class="aksi-buttons">
                                <button class="btn-edit" onclick="openEditModal('{{ $layanan->id }}', `{{ json_encode($layanan) }}`)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <form action="{{ route('produk.destroy', $layanan) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus layanan ini?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="6" style="text-align: center;">Belum ada data layanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <div id="tambahModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('tambahModal')">&times;</span>
            <h4>Tambah Layanan</h4>
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <label>Nama Layanan</label>
                <input type="text" name="nama" placeholder="Cth: Cuci Kering Kilat" required />
                <label>Paket</label>
                <select name="paket" required>
                    <option value="">Pilih Paket</option>
                    <option value="Standar">Standar</option>
                    <option value="Express">Express</option>
                </select>
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Kiloan">Kiloan</option>
                    <option value="Satuan">Satuan</option>
                </select>
                <label>Harga</label>
                <input type="number" name="harga" placeholder="Harga per Kilo atau per Satuan" required />
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
    
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('editModal')">&times;</span>
            <h4>Edit Layanan</h4>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
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
                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
        
        function openEditModal(id, layananJson) {
            const layanan = JSON.parse(layananJson);
            const form = document.getElementById('editForm');
            
            // PERBAIKAN UTAMA: Menggunakan URL yang dinamis dan benar
            // Ini akan menghasilkan URL seperti: http://domain.com/produk/1
            let actionUrl = "{{ route('produk.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            form.action = actionUrl;
            
            // Mengisi form (kode ini sudah benar)
            document.getElementById('editNama').value = layanan.nama;
            document.getElementById('editPaket').value = layanan.paket;
            document.getElementById('editKategori').value = layanan.kategori;
            document.getElementById('editHarga').value = layanan.harga;
            
            document.getElementById('editModal').style.display = 'flex';
        }

        window.onclick = function(event) {
            ['tambahModal', 'editModal'].forEach(id => {
                let modal = document.getElementById(id);
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>