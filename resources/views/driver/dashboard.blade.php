<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Driver | Avachive</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
      <a href="/driver/dashboard" class="active flex items-center gap-3 px-4 py-3 rounded-lg text-white bg-teal-500 font-semibold transition-colors">
        <i class="bi bi-box-seam"></i> Pengiriman
      </a>
      <a href="/driver/riwayat" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
        <i class="bi bi-clock-history"></i> Riwayat
      </a>
      <a href="/driver/pengaturan" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
        <i class="bi bi-gear"></i> Pengaturan
      </a>
    </nav>
  </aside>

  <main class="flex-1 p-4 sm:p-6 overflow-y-auto" id="main-content">
    <div class="sticky top-0 z-10 bg-white/80 backdrop-blur-sm border border-slate-200/60 p-4 rounded-xl shadow-lg mb-6 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <span class="text-2xl">🚚</span>
        <div>
          <h1 class="font-semibold text-slate-800 hidden sm:block">Dashboard Driver Laundry</h1>
          <p class="text-xs text-slate-500">Cabang Ciomas</p>
        </div>
      </div>
      <div class="text-sm text-right">
        <p class="font-semibold" id="todayBadge">Jumat, 22 Agustus 2025</p>
        <p class="text-xs text-slate-500">Driver</p>
      </div>
    </div>

    <section class="mb-6">
      <h3 class="text-xl font-semibold text-blue-600 mb-4">Ringkasan Hari Ini</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-gradient-to-br from-blue-600 to-blue-500 text-white p-5 rounded-xl shadow-lg transition hover:-translate-y-1">
          <h4 class="font-medium text-blue-100">Total Pengiriman</h4>
          <p id="countTotal" class="text-4xl font-bold mt-1">0</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-400 text-white p-5 rounded-xl shadow-lg transition hover:-translate-y-1">
          <h4 class="font-medium text-orange-100">Belum Diantar</h4>
          <p id="countBelum" class="text-4xl font-bold mt-1">0</p>
        </div>
        <div class="bg-gradient-to-br from-green-600 to-green-500 text-white p-5 rounded-xl shadow-lg transition hover:-translate-y-1">
          <h4 class="font-medium text-green-100">Sudah Diantar</h4>
          <p id="countSudah" class="text-4xl font-bold mt-1">0</p>
        </div>
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 text-white p-5 rounded-xl shadow-lg transition hover:-translate-y-1">
          <h4 class="font-medium text-slate-300">Presentase Selesai</h4>
          <p id="countPercent" class="text-4xl font-bold mt-1">0%</p>
        </div>
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow-lg p-5">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        <div id="statusTabs" class="flex flex-wrap items-center gap-2">
          <button class="tab active flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full bg-blue-100 text-blue-700 transition-colors" data-status="ALL"><i class="bi bi-ui-checks-grid"></i> Semua</button>
          <button class="tab flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" data-status="Belum Diantar"><i class="bi bi-hourglass-split"></i> Belum</button>
          <button class="tab flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors" data-status="Sudah Diantar"><i class="bi bi-check2-circle"></i> Sudah</button>
        </div>
        <div class="flex w-full md:w-auto items-center gap-2">
          <input type="text" id="searchInput" placeholder="Cari nama, alamat, barang..." class="w-full md:w-64 px-4 py-2 text-sm border border-slate-300 rounded-full focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" />
          <button id="resetBtn" class="px-3 py-2 bg-slate-200 text-slate-700 rounded-full hover:bg-slate-300 transition-transform active:scale-95"><i class="bi bi-arrow-counterclockwise"></i></button>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table id="shipTable" class="w-full text-sm">
          <thead class="hidden md:table-header-group">
            <tr class="bg-slate-200">
              <th class="p-3 text-left font-semibold text-slate-600 rounded-l-lg cursor-pointer" data-key="no">No. <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 cursor-pointer" data-key="nama">Nama <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 cursor-pointer" data-key="alamat">Alamat <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 cursor-pointer" data-key="barang">Barang <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 cursor-pointer" data-key="tanggal">Tanggal Kirim <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 cursor-pointer" data-key="status">Status <span class="sort">↕</span></th>
              <th class="p-3 text-left font-semibold text-slate-600 rounded-r-lg">Aksi</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <tr class="block mb-4 p-4 bg-white rounded-lg shadow-md md:table-row md:mb-0 md:shadow-none md:p-0 md:border-b md:border-slate-200 md:even:bg-slate-50">
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">No: </span>1</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Nama: </span>Andi Saputra</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Alamat: </span>Jl. Anggrek No. 12, Bogor</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Barang: </span>Kemeja Laundry</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Tgl Kirim: </span>03 Agustus 2025</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Status: </span><span class="badge badge-pending text-xs font-semibold inline-block py-1 px-3 rounded-full text-orange-600 bg-orange-200">Belum Diantar</span></td>
              <td class="block py-2 md:table-cell md:p-3">
                <div class="flex gap-2 mt-2 md:mt-0">
                  <button class="btn-detail flex-1 text-sm px-3 py-2 rounded-md bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition active:scale-95" data-nama="Andi Saputra" data-hp="+628123456789" data-alamat="Jl. Anggrek No. 12, Bogor" data-barang="Kemeja Laundry" data-metode="Diantar" data-pembayaran="Tunai" data-tanggal="03 Agustus 2025">
                    <i class="bi bi-eye mr-1"></i> Detail
                  </button>
                  <button class="btn-selesai flex-1 text-sm px-3 py-2 rounded-md bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition active:scale-95">
                    <i class="bi bi-check-circle mr-1"></i> Selesai
                  </button>
                </div>
              </td>
            </tr>
            <tr class="block mb-4 p-4 bg-white rounded-lg shadow-md md:table-row md:mb-0 md:shadow-none md:p-0 md:border-b md:border-slate-200 md:even:bg-slate-50">
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">No: </span>2</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Nama: </span>Siti Aminah</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Alamat: </span>Perumahan Citra Asri Blok B2</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Barang: </span>Seprai + Gorden</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Tgl Kirim: </span>02 Agustus 2025</td>
              <td class="block py-1 md:table-cell md:p-3"><span class="font-semibold md:hidden">Status: </span><span class="badge badge-pending text-xs font-semibold inline-block py-1 px-3 rounded-full text-orange-600 bg-orange-200">Belum Diantar</span></td>
              <td class="block py-2 md:table-cell md:p-3">
                <div class="flex gap-2 mt-2 md:mt-0">
                  <button class="btn-detail flex-1 text-sm px-3 py-2 rounded-md bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition active:scale-95" data-nama="Siti Aminah" data-hp="+628777888999" data-alamat="Perumahan Citra Asri Blok B2" data-barang="Seprai + Gorden" data-metode="Diantar" data-pembayaran="Transfer" data-tanggal="02 Agustus 2025">
                    <i class="bi bi-eye mr-1"></i> Detail
                  </button>
                  <button class="btn-selesai flex-1 text-sm px-3 py-2 rounded-md bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition active:scale-95">
                    <i class="bi bi-check-circle mr-1"></i> Selesai
                  </button>
                </div>
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
      <a href="/driver/dashboard" class="active flex flex-col items-center justify-center text-teal-400 p-2 rounded-lg w-full">
        <i class="bi bi-box-seam text-xl"></i><span class="text-xs">Pengiriman</span>
      </a>
      <a href="/driver/riwayat" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-clock-history text-xl"></i><span class="text-xs">Riwayat</span>
      </a>
      <a href="/driver/pengaturan" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-gear text-xl"></i><span class="text-xs">Pengaturan</span>
      </a>
  </nav>

</div>

<div class="modal hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 justify-center items-center p-4" id="detailModal">
  <div class="modal-content bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg relative animate-scale-up">
    <button class="modal-close absolute top-3 right-4 text-2xl text-slate-500 hover:text-slate-800" id="modalCloseBtn">×</button>
    <h4 class="text-xl font-bold text-blue-600 mb-4">Detail Pengiriman</h4>

    <div class="space-y-3 text-sm">
      <p><strong>Nama:</strong> <span id="modalNama"></span></p>
      <p><strong>No HP:</strong> <span id="modalHp"></span></p>
      <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
      <p><strong>Barang:</strong> <span id="modalBarang"></span></p>
      <p><strong>Metode Pengiriman:</strong> <span id="modalMetode"></span></p>
      <p><strong>Pembayaran:</strong> <span id="modalPembayaran"></span></p>
      <p><strong>Tanggal Kirim:</strong> <span id="modalTanggal"></span></p>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
      <a href="#" id="whatsappLink" class="flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-green-500 text-white font-semibold shadow hover:bg-green-600 transition active:scale-95" target="_blank">
        <i class="bi bi-whatsapp"></i> WhatsApp
      </a>
      <a href="#" id="mapLink" class="flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-slate-700 text-white font-semibold shadow hover:bg-slate-800 transition active:scale-95" target="_blank">
        <i class="bi bi-geo-alt-fill"></i> Lihat di Maps
      </a>
    </div>
  </div>
</div>

<button class="fab hidden fixed right-6 bottom-20 md:bottom-6 z-20 w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg grid place-items-center text-2xl hover:bg-blue-700 transition active:scale-95" id="scrollTopBtn" title="Kembali ke atas">
  <i class="bi bi-arrow-up"></i>
</button>

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
  // JAVASCRIPT LOGIC (DIPERTAHANKAN DAN DISESUAIKAN)
  // ==========================================================

  // ====== UTIL ======
  const el = sel => document.querySelector(sel);
  const els = sel => document.querySelectorAll(sel);
  const mainContent = el('#main-content');

  // Today badge
  (function setToday(){
    const d = new Date();
    const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
    el('#todayBadge').textContent = d.toLocaleDateString('id-ID', opts);
  })();

  // ====== COUNT & PERCENT ======
  function recalcCounters(){
    const rows = [...el('#tbody').querySelectorAll('tr')];
    const total = rows.length;
    const belum = rows.filter(r => r.querySelector('.badge-pending')).length;
    const sudah = total - belum;
    el('#countTotal').textContent = total;
    el('#countBelum').textContent = belum;
    el('#countSudah').textContent = sudah;
    el('#countPercent').textContent = total ? Math.round((sudah/total)*100)+'%' : '0%';
  }

  // ====== MODAL DETAIL ======
  const modal = el('#detailModal');
  const modalClose = el('#modalCloseBtn');

  function openModal(data){
    el('#modalNama').textContent = data.nama;
    el('#modalHp').textContent = data.hp;
    el('#modalAlamat').textContent = data.alamat;
    el('#modalBarang').textContent = data.barang;
    el('#modalMetode').textContent = data.metode;
    el('#modalPembayaran').textContent = data.pembayaran;
    el('#modalTanggal').textContent = data.tanggal;

    const waMessage = `Halo ${data.nama}, pesanan laundry Anda (${data.barang}) akan segera diantar ke alamat: ${data.alamat}. Mohon siapkan pembayaran (${data.pembayaran}). Terima kasih 🙏 - Avachive Driver`;
    el('#whatsappLink').href = `https://wa.me/${data.hp.replace('+','')}?text=${encodeURIComponent(waMessage)}`;
    el('#mapLink').href = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.alamat)}`;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }
  function closeModal(){
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
  modalClose.addEventListener('click', closeModal);
  window.addEventListener('click', (e)=>{ if(e.target === modal) closeModal(); });

  function bindDetailButtons(scope=document){
    scope.querySelectorAll('.btn-detail').forEach(button=>{
      button.addEventListener('click', ()=>{
        openModal({
          nama: button.dataset.nama,
          hp: button.dataset.hp,
          alamat: button.dataset.alamat,
          barang: button.dataset.barang,
          metode: button.dataset.metode,
          pembayaran: button.dataset.pembayaran,
          tanggal: button.dataset.tanggal
        });
      });
    });
  }

  // ====== ACTION SELESAI ======
  function bindSelesaiButtons(scope=document){
    scope.querySelectorAll('.btn-selesai').forEach(btn=>{
      if(btn.dataset.bound === '1') return;
      btn.dataset.bound = '1';

      btn.addEventListener('click', ()=>{
        Swal.fire({
          title: 'Selesaikan pengiriman ini?',
          text: "Pastikan Anda sudah berada di lokasi yang benar.",
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Selesai',
          cancelButtonText: 'Batal',
          confirmButtonColor: '#16a34a', // green-600
          cancelButtonColor: '#dc2626'  // red-600
        }).then(res=>{
          if(res.isConfirmed){
            const row = btn.closest('tr');
            const statusCell = row.querySelector('td:nth-of-type(6)');
            statusCell.innerHTML = '<span class="font-semibold md:hidden">Status: </span><span class="badge badge-done text-xs font-semibold inline-block py-1 px-3 rounded-full text-green-700 bg-green-200">Sudah Diantar</span>';
            recalcCounters();
            Swal.fire('Berhasil!', 'Pengiriman telah ditandai selesai.', 'success');
            applyFilters();
          }
        });
      });
    });
  }

  // ====== SEARCH & FILTER ======
  let activeStatus = 'ALL';
  const searchInput = el('#searchInput');
  const resetBtn = el('#resetBtn');

  function normalize(s){ return (s||'').toString().toLowerCase(); }

  function rowMatchesSearch(row, q){
    if(!q) return true;
    const tds = row.querySelectorAll('td');
    const nama = tds[1]?.textContent || '';
    const alamat = tds[2]?.textContent || '';
    const barang = tds[3]?.textContent || '';
    const haystack = normalize(`${nama} ${alamat} ${barang}`);
    return haystack.includes(normalize(q));
  }
  
  function rowMatchesStatus(row){
    if(activeStatus === 'ALL') return true;
    const statusTxt = row.querySelector('td:nth-of-type(6)')?.textContent.trim() || '';
    return statusTxt === activeStatus;
  }

  function applyFilters(){
    const q = searchInput.value.trim();
    const rows = [...el('#tbody').querySelectorAll('tr')];
    let visibleCount = 0;
    rows.forEach((r)=>{
      const isVisible = rowMatchesSearch(r, q) && rowMatchesStatus(r);
      r.style.display = isVisible ? '' : 'none';
      
      if(isVisible){
        visibleCount++;
        const noCell = r.querySelector('td:first-child');
        if(noCell) {
          // Memastikan label mobile tetap ada setelah filter/sort
          noCell.innerHTML = `<span class="font-semibold md:hidden">No: </span>${visibleCount}`;
        }
      }
    });
  }
  searchInput.addEventListener('input', applyFilters);

  resetBtn.addEventListener('click', ()=>{
    searchInput.value = '';
    activeStatus = 'ALL';
    el('#statusTabs').querySelectorAll('.tab').forEach(t=>{
        t.classList.remove('active', 'bg-blue-100', 'text-blue-700');
        t.classList.add('bg-slate-100', 'hover:bg-slate-200', 'text-slate-600');
    });
    const allTab = el('#statusTabs').querySelector('[data-status="ALL"]');
    allTab.classList.add('active', 'bg-blue-100', 'text-blue-700');
    allTab.classList.remove('bg-slate-100', 'hover:bg-slate-200', 'text-slate-600');
    applyFilters();
  });

  el('#statusTabs').querySelectorAll('.tab').forEach(tab=>{
    tab.addEventListener('click', ()=>{
      el('#statusTabs').querySelectorAll('.tab').forEach(t=>{
          t.classList.remove('active', 'bg-blue-100', 'text-blue-700');
          t.classList.add('bg-slate-100', 'hover:bg-slate-200', 'text-slate-600');
      });
      tab.classList.add('active', 'bg-blue-100', 'text-blue-700');
      tab.classList.remove('bg-slate-100', 'hover:bg-slate-200', 'text-slate-600');
      activeStatus = tab.dataset.status;
      applyFilters();
    });
  });

  // ====== SORT TABLE ======
  let sortState = { key:null, dir:1 };
  const keyIndex = { no:0, nama:1, alamat:2, barang:3, tanggal:4, status:5 };

  function parseDateId(text){
    const map = { januari:0,februari:1,maret:2,april:3,mei:4,juni:5, juli:6,agustus:7,september:8,oktober:9,november:10,desember:11 };
    const parts = text.trim().toLowerCase().split(' ');
    if(parts.length < 3) return 0;
    const d = parseInt(parts[0],10)||1;
    const m = map[parts[1]] ?? 0;
    const y = parseInt(parts[2],10)||1970;
    return new Date(y,m,d).getTime();
  }

  function sortBy(key){
    if(sortState.key === key) sortState.dir *= -1;
    else { sortState.key = key; sortState.dir = 1; }

    const idx = keyIndex[key];
    const rows = Array.from(el('#tbody').rows);

    rows.sort((a,b)=>{
      const A = a.cells[idx]?.innerText.trim() || '';
      const B = b.cells[idx]?.innerText.trim() || '';
      if(key === 'tanggal'){
        return (parseDateId(A) - parseDateId(B)) * sortState.dir;
      } else if(key === 'no'){
        return (parseInt(A,10)-parseInt(B,10)) * sortState.dir;
      } else {
        return A.localeCompare(B, 'id', { sensitivity: 'base' }) * sortState.dir;
      }
    });

    rows.forEach(r => el('#tbody').appendChild(r));
    applyFilters();
  }

  document.querySelectorAll('thead th[data-key]').forEach(th=>{
    th.addEventListener('click', ()=> sortBy(th.dataset.key));
  });

  // ====== SCROLL TOP FAB ======
  const scrollBtn = el('#scrollTopBtn');
  scrollBtn.addEventListener('click', ()=> mainContent.scrollTo({ top:0, behavior:'smooth' }));
  mainContent.addEventListener('scroll', ()=>{
    scrollBtn.style.display = (mainContent.scrollTop > 300) ? 'grid' : 'none';
  });

  // ====== INIT ======
  function init(){
    bindDetailButtons();
    bindSelesaiButtons();
    recalcCounters();
    applyFilters();
  }
  init();

</script>

</body>
</html>