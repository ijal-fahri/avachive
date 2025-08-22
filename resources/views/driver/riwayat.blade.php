<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Riwayat Pengiriman | Avachive</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7fc;
      color: #333;
      margin: 0;
    }
    .admin-wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background: #1e272e;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 1rem;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 1.6rem;
      font-weight: 600;
      color: #00cec9;
    }
    .sidebar a {
      color: #dcdde1;
      text-decoration: none;
      margin: 0.4rem 0;
      padding: 0.75rem 1rem;
      border-radius: 10px;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background: #00cec9;
      color: #fff;
    }
    /* Main Content */
    .main-content {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }
    .topbar {
      background: #fff;
      padding: 1rem 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .topbar .user-info {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 500;
      color: #2f3640;
    }
    /* Section */
    .dashboard-section {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.04);
      margin-bottom: 2rem;
      animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .dashboard-section h3 {
      margin-top: 0;
      font-weight: 600;
      color: #0984e3;
      margin-bottom: 1rem;
    }
    .stat-box {
      display: flex;
      gap: 1.2rem;
      flex-wrap: wrap;
    }
    .stat-card {
      flex: 1;
      min-width: 220px;
      background: linear-gradient(135deg, #74b9ff, #0984e3);
      padding: 1.5rem;
      border-radius: 14px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.05);
      text-align: center;
      color: white;
    }
    .stat-card h4 {
      margin: 0;
      font-size: 1.1rem;
      font-weight: 400;
    }
    .stat-card p {
      font-size: 1.8rem;
      font-weight: 700;
      margin-top: 0.5rem;
    }
    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 0.9rem;
      text-align: left;
      font-size: 14px;
    }
    th {
      background-color: #0984e3;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f1f2f6;
    }
    .badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      color: #fff;
    }
    .badge-done { background-color: #2ecc71; }
    .btn {
      padding: 6px 12px;
      font-size: 13px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-detail { background-color: #2980b9; color: white; }
    .btn:hover { opacity: 0.9; }
    /* Modal */
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
      border-radius: 14px;
      width: 90%;
      max-width: 480px;
      position: relative;
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
      animation: fadeIn 0.3s ease-in-out;
    }
    .modal-close {
      position: absolute;
      top: 12px;
      right: 18px;
      font-size: 22px;
      color: #888;
      cursor: pointer;
    }
    .detail-box p { 
      margin: 6px 0; 
      font-size: 14px; 
      line-height: 1.5;
    }
    /* Tombol WA & Maps */
    .btn-green {
      background-color: #25d366;
      color: white;
      font-weight: 600;
      border-radius: 50px;
      padding: 10px 18px;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 3px 8px rgba(37, 211, 102, 0.4);
      transition: all 0.3s ease;
      text-decoration: none !important;
    }
    .btn-green:hover {
      background-color: #1ebe5b;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(37, 211, 102, 0.6);
    }
    .btn-gray {
      background-color: #576574;
      color: white;
      font-weight: 600;
      border-radius: 50px;
      padding: 10px 18px;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 3px 8px rgba(87, 101, 116, 0.4);
      transition: all 0.3s ease;
      text-decoration: none !important;
    }
    .btn-gray:hover {
      background-color: #2f3640;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(87, 101, 116, 0.6);
    }
    .button-group {
      margin-top: 20px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.85rem;
      color: #888;
    }
    @media (max-width: 768px) {
      .admin-wrapper {
        flex-direction: column;
      }
      .sidebar {
        flex-direction: row;
        overflow-x: auto;
        width: 100%;
        padding: 0.5rem;
      }
      .sidebar a {
        flex: 1;
        justify-content: center;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

<div class="admin-wrapper">
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <h2>Avachive Driver</h2>
    </div>
    <nav class="nav">
      <a href="/driver/dashboard" ><i class="bi bi-box-seam"></i> Pengiriman</a>
      <a href="/driver/riwayat" class="active"><i class="bi bi-clock-history"></i> Riwayat</a>
      <a href="/driver/pengaturan"><i class="bi bi-gear"></i> Pengaturan</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="topbar">
      <div>🕒 Riwayat Pengiriman</div>
      <div class="user-info">
        <i class="bi bi-person-circle fs-5"></i> Driver
      </div>
    </div>

    <!-- Statistik -->
    <section class="dashboard-section">
      <h3>Ringkasan Pengiriman</h3>
      <div class="stat-box">
        <div class="stat-card">
          <h4>Total Terkirim</h4>
          <p id="countTerkirim">0</p>
        </div>
      </div>
    </section>

    <!-- Tabel Riwayat -->
    <section class="dashboard-section">
      <h3>Daftar Riwayat</h3>
      <table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Barang</th>
            <th>Tanggal Kirim</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Andi Saputra</td>
            <td>Jl. Anggrek No. 12, Bogor</td>
            <td>Kemeja Laundry</td>
            <td>03 Agustus 2025</td>
            <td><span class="badge badge-done">Terkirim</span></td>
            <td>
              <button class="btn btn-detail"
                data-nama="Andi Saputra"
                data-hp="+628123456789"
                data-alamat="Jl. Anggrek No. 12, Bogor"
                data-barang="Kemeja Laundry"
                data-metode="Diantar"
                data-pembayaran="Tunai"
                data-tanggal="03 Agustus 2025">
                <i class="bi bi-eye"></i> Detail
              </button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Siti Aminah</td>
            <td>Perumahan Citra Asri Blok B2</td>
            <td>Seprai + Gorden</td>
            <td>02 Agustus 2025</td>
            <td><span class="badge badge-done">Terkirim</span></td>
            <td>
              <button class="btn btn-detail"
                data-nama="Siti Aminah"
                data-hp="+628777888999"
                data-alamat="Perumahan Citra Asri Blok B2"
                data-barang="Seprai + Gorden"
                data-metode="Diantar"
                data-pembayaran="Transfer"
                data-tanggal="02 Agustus 2025">
                <i class="bi bi-eye"></i> Detail
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>

    <footer>
      &copy; 2025 Avachive Driver. All rights reserved.
    </footer>
  </main>
</div>

<!-- Modal -->
<div class="modal" id="detailModal">
  <div class="modal-content">
    <span class="modal-close" onclick="closeModal()">&times;</span>
    <h4 style="margin-bottom:10px; color:#0984e3;">Detail Pengiriman</h4>
    <div class="detail-box">
      <p><strong>Nama:</strong> <span id="modalNama"></span></p>
      <p><strong>No HP:</strong> <span id="modalHp"></span></p>
      <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
      <p><strong>Barang:</strong> <span id="modalBarang"></span></p>
      <p><strong>Metode Pengiriman:</strong> <span id="modalMetode"></span></p>
      <p><strong>Pembayaran:</strong> <span id="modalPembayaran"></span></p>
      <p><strong>Tanggal Kirim:</strong> <span id="modalTanggal"></span></p>
    </div>
    <div class="button-group">
      <a href="#" id="whatsappLink" class="btn-green" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
      <a href="#" id="mapLink" class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i> Lihat di Maps</a>
    </div>
  </div>
</div>

<script>
  // Hitung jumlah terkirim
  let totalTerkirim = document.querySelectorAll(".badge-done").length;
  document.getElementById("countTerkirim").textContent = totalTerkirim;

  const detailButtons = document.querySelectorAll('.btn-detail');
  const modal = document.getElementById('detailModal');

  detailButtons.forEach(button => {
    button.addEventListener('click', () => {
      const nama = button.dataset.nama;
      const hp = button.dataset.hp;
      const alamat = button.dataset.alamat;
      const barang = button.dataset.barang;
      const metode = button.dataset.metode;
      const pembayaran = button.dataset.pembayaran;
      const tanggal = button.dataset.tanggal;

      document.getElementById('modalNama').textContent = nama;
      document.getElementById('modalHp').textContent = hp;
      document.getElementById('modalAlamat').textContent = alamat;
      document.getElementById('modalBarang').textContent = barang;
      document.getElementById('modalMetode').textContent = metode;
      document.getElementById('modalPembayaran').textContent = pembayaran;
      document.getElementById('modalTanggal').textContent = tanggal;

      document.getElementById('mapLink').href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(alamat)}`;
      document.getElementById('whatsappLink').href = `https://wa.me/${hp.replace('+', '')}?text=Halo%20${encodeURIComponent(nama)},%20pesanan%20anda%20telah%20diantar.%20Terima%20kasih!`;

      modal.style.display = "flex";
    });
  });

  function closeModal() {
    modal.style.display = "none";
  }
  window.onclick = function(e) {
    if (e.target === modal) closeModal();
  }
</script>

</body>
</html>
