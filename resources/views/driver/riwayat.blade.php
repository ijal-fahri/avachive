<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pengiriman | Avachive</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    /* Custom styles untuk Poppins font & scrollbar */
    body {
      font-family: 'Poppins', sans-serif;
    }
    /* Simple Scrollbar Styling */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; }
    ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #64748b; }
  </style>
</head>

<body class="bg-slate-100 text-slate-800 antialiased">

<div class="flex h-screen overflow-hidden bg-slate-100">
  
  <aside id="sidebar" class="w-64 bg-slate-900 text-slate-300 p-4 flex-col hidden md:flex">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-bold text-teal-400">Avachive Driver</h2>
    </div>
    <nav class="flex flex-col space-y-2">
      <a href="/driver/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
        <i class="bi bi-box-seam"></i> Pengiriman
      </a>
      <a href="/driver/riwayat" class="active flex items-center gap-3 px-4 py-3 rounded-lg text-white bg-teal-500 font-semibold transition-colors">
        <i class="bi bi-clock-history"></i> Riwayat
      </a>
      <a href="/driver/pengaturan" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
        <i class="bi bi-gear"></i> Pengaturan
      </a>
    </nav>
  </aside>

  <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
    <div class="sticky top-0 z-10 bg-white/80 backdrop-blur-sm border border-slate-200/60 p-4 rounded-xl shadow-lg mb-6 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <span class="text-2xl">🕒</span>
        <div>
          <h1 class="font-semibold text-slate-800">Riwayat Pengiriman</h1>
          <p class="text-xs text-slate-500" id="current-date">Jumat, 22 Agustus 2025</p>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <span class="font-semibold text-sm hidden sm:inline">Driver</span>
        <i class="bi bi-person-circle text-2xl text-slate-600"></i>
      </div>
    </div>

    <section class="mb-6">
      <h3 class="text-xl font-semibold text-blue-600 mb-4">Ringkasan</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-gradient-to-br from-green-600 to-green-500 text-white p-5 rounded-xl shadow-lg transition hover:-translate-y-1">
          <h4 class="font-medium text-green-100">Total Pengiriman Selesai</h4>
          <p id="countTerkirim" class="text-4xl font-bold mt-1">0</p>
        </div>
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow-lg p-5">
      <h3 class="text-xl font-semibold text-slate-800 mb-4">Daftar Riwayat</h3>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="hidden md:table-header-group">
            <tr class="bg-slate-200">
              <th class="p-3 text-left font-semibold text-slate-600 rounded-l-lg">No.</th>
              <th class="p-3 text-left font-semibold text-slate-600">Nama</th>
              <th class="p-3 text-left font-semibold text-slate-600">Alamat</th>
              <th class="p-3 text-left font-semibold text-slate-600">Barang</th>
              <th class="p-3 text-left font-semibold text-slate-600">Tanggal Kirim</th>
              <th class="p-3 text-left font-semibold text-slate-600">Status</th>
              <th class="p-3 text-left font-semibold text-slate-600 rounded-r-lg">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr class="block mb-4 p-4 bg-white rounded-lg shadow-md md:table-row md:mb-0 md:shadow-none md:p-0 md:border-b md:border-slate-200 md:even:bg-slate-50">
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">No: </span>1</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Nama: </span>Andi Saputra</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Alamat: </span>Jl. Anggrek No. 12, Bogor</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Barang: </span>Kemeja Laundry</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Tgl Kirim: </span>03 Agustus 2025</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="badge-done text-xs font-semibold inline-block py-1 px-3 rounded-full text-green-700 bg-green-100">Terkirim</span></td>
              <td class="block py-2 md:table-cell md:p-3">
                <button class="btn-detail w-full md:w-auto text-sm px-4 py-2 rounded-md bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition active:scale-95" data-nama="Andi Saputra" data-hp="+628123456789" data-alamat="Jl. Anggrek No. 12, Bogor" data-barang="Kemeja Laundry" data-metode="Diantar" data-pembayaran="Tunai" data-tanggal="03 Agustus 2025">
                  <i class="bi bi-eye mr-1"></i> Detail
                </button>
              </td>
            </tr>
            <tr class="block mb-4 p-4 bg-white rounded-lg shadow-md md:table-row md:mb-0 md:shadow-none md:p-0 md:border-b md:border-slate-200 md:even:bg-slate-50">
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">No: </span>2</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Nama: </span>Siti Aminah</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Alamat: </span>Perumahan Citra Asri Blok B2</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Barang: </span>Seprai + Gorden</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Tgl Kirim: </span>02 Agustus 2025</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="badge-done text-xs font-semibold inline-block py-1 px-3 rounded-full text-green-700 bg-green-100">Terkirim</span></td>
              <td class="block py-2 md:table-cell md:p-3">
                <button class="btn-detail w-full md:w-auto text-sm px-4 py-2 rounded-md bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition active:scale-95" data-nama="Siti Aminah" data-hp="+628777888999" data-alamat="Perumahan Citra Asri Blok B2" data-barang="Seprai + Gorden" data-metode="Diantar" data-pembayaran="Transfer" data-tanggal="02 Agustus 2025">
                  <i class="bi bi-eye mr-1"></i> Detail
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <footer class="text-center py-6 text-sm text-slate-500">
      © 2025 Avachive Driver. All rights reserved.
    </footer>
  </main>
  
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-slate-900 text-slate-300 p-2 flex justify-around shadow-lg">
      <a href="/driver/dashboard" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-box-seam text-xl"></i><span class="text-xs">Pengiriman</span>
      </a>
      <a href="/driver/riwayat" class="active flex flex-col items-center justify-center text-teal-400 p-2 rounded-lg w-full">
        <i class="bi bi-clock-history text-xl"></i><span class="text-xs">Riwayat</span>
      </a>
      <a href="/driver/pengaturan" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-gear text-xl"></i><span class="text-xs">Pengaturan</span>
      </a>
  </nav>

</div>

<div class="modal hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 justify-center items-center p-4" id="detailModal">
  <div class="modal-content bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg relative animate-scale-up">
    <button class="modal-close absolute top-3 right-4 text-2xl text-slate-500 hover:text-slate-800" onclick="closeModal()">×</button>
    <h4 class="text-xl font-bold text-blue-600 mb-4">Detail Pengiriman</h4>
    
    <div class="detail-box space-y-3 text-sm">
      <p><strong>Nama:</strong> <span id="modalNama"></span></p>
      <p><strong>No HP:</strong> <span id="modalHp"></span></p>
      <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
      <p><strong>Barang:</strong> <span id="modalBarang"></span></p>
      <p><strong>Metode Pengiriman:</strong> <span id="modalMetode"></span></p>
      <p><strong>Pembayaran:</strong> <span id="modalPembayaran"></span></p>
      <p><strong>Tanggal Kirim:</strong> <span id="modalTanggal"></span></p>
    </div>
    
    <div class="button-group mt-6 flex flex-wrap gap-3">
      <a href="#" id="whatsappLink" class="flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-green-500 text-white font-semibold shadow hover:bg-green-600 transition active:scale-95" target="_blank">
        <i class="bi bi-whatsapp"></i> WhatsApp
      </a>
      <a href="#" id="mapLink" class="flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-slate-700 text-white font-semibold shadow hover:bg-slate-800 transition active:scale-95" target="_blank">
        <i class="bi bi-geo-alt-fill"></i> Lihat di Maps
      </a>
    </div>
  </div>
</div>

<style>
  /* Animasi untuk modal */
  @keyframes scale-up {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }
  .animate-scale-up {
    animation: scale-up 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
  }
</style>

<script>
  // ==========================================================
  // JAVASCRIPT LOGIC (TIDAK DIUBAH, HANYA PENYESUAIAN KECIL)
  // ==========================================================
  
  // Set tanggal hari ini
  document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', {
    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
  });

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

      document.getElementById('mapLink').href = `http://googleusercontent.com/maps.google.com/2{encodeURIComponent(alamat)}`;
      document.getElementById('whatsappLink').href = `https://wa.me/${hp.replace('+', '')}?text=Halo%20${encodeURIComponent(nama)},%20ini%20adalah%20konfirmasi%20riwayat%20pengiriman%20Anda.%20Terima%20kasih!`;

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });
  });

  function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  window.onclick = function(e) {
    if (e.target === modal) closeModal();
  }
</script>

</body>
</html>