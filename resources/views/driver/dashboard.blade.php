<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Driver | Avachive</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    :root{
      --bg: #f0f4f8;
      --bg-soft: #eef3f7;
      --card: #ffffff;
      --text: #2d3436;
      --muted: #7f8c8d;
      --brand: #0984e3;
      --brand-2: #00cec9;
      --good: #2ecc71;
      --warn: #e67e22;
      --shadow: 0 8px 24px rgba(0,0,0,.08);
      --radius: 18px;
    }
    html, body { height: 100%; }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, var(--bg), var(--bg-soft));
      color: var(--text);
    }

    .admin-wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    /* ====== SIDEBAR (TIDAK DIUBAH) ====== */
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
      white-space: nowrap;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background: #00cec9;
      color: #fff;
    }

    /* ====== MAIN ====== */
    .main-content {
      flex: 1;
      padding: 1.5rem 2rem 2rem;
      overflow-y: auto;
      position: relative;
    }

    .topbar {
      position: sticky;
      top: 0;
      z-index: 5;
      background: rgba(255,255,255,.75);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(0,0,0,.05);
      padding: 1rem 1.25rem;
      border-radius: 14px;
      box-shadow: var(--shadow);
      margin-bottom: 1.25rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .topbar .title {
      display: flex;
      align-items: center;
      gap: .75rem;
      font-weight: 700;
      letter-spacing: .2px;
    }
    .topbar .title .badge-day {
      font-size: .75rem;
      background: #eaf6ff;
      color: var(--brand);
      padding: .25rem .6rem;
      border-radius: 999px;
      border: 1px solid #d9ecff;
    }
    .topbar .user-info {
      display: flex;
      align-items: center;
      gap: .6rem;
      font-weight: 600;
      color: #2f3640;
    }

    /* ====== CARDS ====== */
    .dashboard-section {
      background: var(--card);
      padding: 1.5rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      margin-bottom: 1.25rem;
      animation: fadeIn .4s ease;
    }
    @keyframes fadeIn { from{opacity:0; transform: translateY(10px)} to{opacity:1; transform:none} }
    .dashboard-section h3 {
      margin-bottom: 1rem;
      font-weight: 700;
      color: var(--brand);
      letter-spacing: .2px;
    }

    .stat-grid{
      display: grid;
      grid-template-columns: repeat(4, minmax(0,1fr));
      gap: 1rem;
    }
    .stat-card {
      background: linear-gradient(135deg, #0984e3, #6c5ce7);
      padding: 1.25rem;
      border-radius: 16px;
      color: #fff;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
    }
    .stat-card:nth-child(2){ background: linear-gradient(135deg, #0984e3,  #6c5ce7); }
    .stat-card:nth-child(3){ background: linear-gradient(135deg, #0984e3, #6c5ce7); }
    .stat-card:nth-child(4){ background: linear-gradient(135deg, #0984e3, #6c5ce7); }
    .stat-card h4 { font-size: .95rem; opacity: .95; font-weight: 600; }
    .stat-card p { font-size: 2rem; font-weight: 800; margin-top: .35rem; line-height: 1; }

    /* ====== FILTER BAR ====== */
    .filters{
      display: grid;
      grid-template-columns: 1fr auto;
      gap: .8rem;
      margin-bottom: .75rem;
      align-items: center;
    }
    .tabs{
      display: flex;
      gap: .5rem;
      flex-wrap: wrap;
    }
    .tab{
      background: #f3f6fa;
      border: 1px solid #e7edf6;
      padding: .55rem .9rem;
      border-radius: 999px;
      cursor: pointer;
      font-size: .9rem;
      font-weight: 600;
      transition: .2s;
      user-select: none;
    }
    .tab.active{
      background: #eaf8ff;
      border-color: #cbe9ff;
      color: var(--brand);
    }
    .searchbar{
      display: flex;
      gap: .5rem;
      align-items: center;
    }
    .input{
      background: #fff;
      border: 1px solid #e4e9f1;
      padding: .6rem .9rem;
      border-radius: 10px;
      outline: none;
      min-width: 260px;
      box-shadow: 0 2px 8px rgba(0,0,0,.03) inset;
    }
    .btn{
      padding: .55rem .9rem;
      font-size: .9rem;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      transition: transform .15s ease, box-shadow .15s ease, background .2s;
      box-shadow: 0 6px 14px rgba(0,0,0,.06);
    }
    .btn:hover{ transform: translateY(-1px); }
    .btn-primary{ background: var(--brand); color:#fff; }
    .btn-soft{ background: #f3f6fa; }
    .btn-green{ background: var(--good); color:#fff; border-radius: 999px; padding:.6rem 1rem; text-decoration: none; }
    .btn-gray{ background: #eef1f6; color:#2d3436; border-radius: 999px; padding:.6rem 1rem; text-decoration: none; }
    .btn-detail{ background:#2980b9; color:#fff; }
    .btn-selesai{ background:#27ae60; color:#fff; }

    /* ====== TABLE ====== */
    .table-wrap{
      border: 1px solid #e8edf4;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: var(--shadow);
    }
    table { width: 100%; border-collapse: collapse; }
    thead th{
      background: var(--brand);
      color:#fff;
      text-align: left;
      font-weight: 700;
      padding: .85rem .9rem;
      position: relative;
      cursor: pointer;
      user-select: none;
    }
    thead th .sort{
      margin-left: .4rem;
      font-size: .85rem;
      opacity: .9;
    }
    tbody td{
      padding: .85rem .9rem;
      border-bottom: 1px solid #f0f3f8;
      background: #fff;
    }
    tbody tr:nth-child(even) td{ background: #fafcff; }
    tbody tr:hover td{ background: #f5f9ff; }

    .badge{
      padding: .35rem .7rem;
      border-radius: 999px;
      font-size: .75rem;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
    }
    .badge-pending{ background: var(--warn); }
    .badge-done{ background: var(--good); }

    footer{
      text-align: center;
      padding: 1rem .5rem;
      font-size: .85rem;
      color: #94a3b8;
    }

    /* ====== MODAL ====== */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      animation: fadeIn .25s ease;
      padding: 1rem;
    }
    .modal-content {
      background-color: white;
      padding: 22px;
      border-radius: 16px;
      width: 100%;
      max-width: 560px;
      position: relative;
      box-shadow: var(--shadow);
      animation: scaleUp .2s ease-in-out;
    }
    @keyframes scaleUp { from { transform: scale(0.98); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-close {
      position: absolute; top: 10px; right: 12px; font-size: 22px; color: #94a3b8; cursor: pointer;
    }
    .detail-grid{
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: .6rem .9rem;
      margin-top: .6rem;
    }
    .detail-grid p{ font-size: .95rem; }
    .button-group { margin-top: 16px; display: flex; gap: 10px; flex-wrap: wrap; }

    /* ====== FLOAT ACTION (optional) ====== */
    .fab{
      position: fixed;
      right: 22px; bottom: 22px;
      background: var(--brand);
      color: #fff;
      width: 54px; height: 54px;
      border-radius: 50%;
      display: grid; place-items: center;
      box-shadow: var(--shadow);
      cursor: pointer;
      z-index: 9;
    }

    /* ====== RESPONSIVE ====== */
    @media (max-width: 1200px){
      .stat-grid{ grid-template-columns: repeat(2,minmax(0,1fr)); }
    }
    @media (max-width: 900px){
      .filters{ grid-template-columns: 1fr; }
      .searchbar{ justify-content: space-between; }
      .input{ flex: 1; min-width: 0; }
      .detail-grid{ grid-template-columns: 1fr; }
    }
    @media (max-width: 768px){
      .admin-wrapper { flex-direction: column; }
      .sidebar {
        flex-direction: row;
        overflow-x: auto;
        width: 100%;
        padding: 0.5rem;
      }
      .sidebar a { flex: 1; justify-content: center; font-size: 0.9rem; }

      /* table => cards */
      .table-wrap { border: none; box-shadow: none; }
      table, thead, tbody, th, td, tr { display: block; }
      thead { display: none; }
      tbody tr{
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: .75rem .85rem;
        margin-bottom: .8rem;
        box-shadow: var(--shadow);
      }
      tbody td{
        border: none;
        padding: .35rem 0;
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: .5rem;
      }
      tbody td::before{
        content: attr(data-label);
        font-weight: 700;
        color: var(--muted);
      }
      .topbar{ border-radius: 12px; }
      
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
      <a href="/driver/dashboard" class="active"><i class="bi bi-box-seam"></i> Pengiriman</a>
      <a href="/driver/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a>
      <a href="/driver/pengaturan"><i class="bi bi-gear"></i> Pengaturan</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <div class="topbar">
      <div class="title">
        <span style="font-size:1.2rem">🚚</span>
        <span>Dashboard Driver Laundry (Cabang Ciomas)</span>
        <span class="badge-day" id="todayBadge">Hari ini</span>
      </div>
      <div class="user-info">
        <i class="bi bi-person-circle fs-5"></i> Driver
      </div>
    </div>

    <!-- Statistik -->
    <section class="dashboard-section">
      <h3>Ringkasan</h3>
      <div class="stat-grid">
        <div class="stat-card">
          <h4>Total Pengiriman</h4>
          <p id="countTotal">0</p>
        </div>
        <div class="stat-card">
          <h4>Belum Diantar</h4>
          <p id="countBelum">0</p>
        </div>
        <div class="stat-card">
          <h4>Sudah Diantar</h4>
          <p id="countSudah">0</p>
        </div>
        <div class="stat-card">
          <h4>Presentase Selesai</h4>
          <p id="countPercent">0%</p>
        </div>
      </div>
    </section>

    <!-- Daftar Pengiriman -->
    <section class="dashboard-section">
      <div class="filters">
        <div class="tabs" id="statusTabs">
          <button class="tab active" data-status="ALL"><i class="bi bi-ui-checks-grid"></i> Semua</button>
          <button class="tab" data-status="Belum Diantar"><i class="bi bi-hourglass-split"></i> Belum</button>
          <button class="tab" data-status="Sudah Diantar"><i class="bi bi-check2-circle"></i> Sudah</button>
        </div>
        <div class="searchbar">
          <input type="text" class="input" id="searchInput" placeholder="Cari nama / alamat / barang..." />
          <button class="btn btn-soft" id="resetBtn"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
        </div>
      </div>

      <div class="table-wrap">
        <table id="shipTable">
          <thead>
            <tr>
              <th data-key="no">No. <span class="sort">↕</span></th>
              <th data-key="nama">Nama <span class="sort">↕</span></th>
              <th data-key="alamat">Alamat <span class="sort">↕</span></th>
              <th data-key="barang">Barang <span class="sort">↕</span></th>
              <th data-key="tanggal">Tanggal Kirim <span class="sort">↕</span></th>
              <th data-key="status">Status <span class="sort">↕</span></th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <!-- ROW 1 -->
            <tr>
              <td data-label="No.">1</td>
              <td data-label="Nama">Andi Saputra</td>
              <td data-label="Alamat">Jl. Anggrek No. 12, Bogor</td>
              <td data-label="Barang">Kemeja Laundry</td>
              <td data-label="Tanggal Kirim">03 Agustus 2025</td>
              <td data-label="Status"><span class="badge badge-pending">Belum Diantar</span></td>
              <td data-label="Aksi">
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
                <button class="btn btn-selesai"><i class="bi bi-check-circle"></i> Selesai</button>
              </td>
            </tr>
            <!-- ROW 2 -->
            <tr>
              <td data-label="No.">2</td>
              <td data-label="Nama">Siti Aminah</td>
              <td data-label="Alamat">Perumahan Citra Asri Blok B2</td>
              <td data-label="Barang">Seprai + Gorden</td>
              <td data-label="Tanggal Kirim">02 Agustus 2025</td>
              <td data-label="Status"><span class="badge badge-pending">Belum Diantar</span></td>
              <td data-label="Aksi">
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
                <button class="btn btn-selesai"><i class="bi bi-check-circle"></i> Selesai</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <footer>
      &copy; 2025 Avachive Driver. All rights reserved.
    </footer>
  </main>
</div>

<!-- Modal -->
<div class="modal" id="detailModal">
  <div class="modal-content">
    <span class="modal-close" id="modalCloseBtn">&times;</span>
    <h4 style="font-size:1.15rem; font-weight:700; color:var(--brand)">Detail Pengiriman</h4>

    <div class="detail-grid">
      <p><strong>Nama:</strong> <span id="modalNama"></span></p>
      <p><strong>No HP:</strong> <span id="modalHp"></span></p>
      <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
      <p><strong>Barang:</strong> <span id="modalBarang"></span></p>
      <p><strong>Metode Pengiriman:</strong> <span id="modalMetode"></span></p>
      <p><strong>Pembayaran:</strong> <span id="modalPembayaran"></span></p>
      <p><strong>Tanggal Kirim:</strong> <span id="modalTanggal"></span></p>
    </div>

    <div class="button-group">
      <a href="#" id="whatsappLink" class="btn-green" target="_blank">
        <i class="bi bi-whatsapp"></i> WhatsApp
      </a>
      <a href="#" id="mapLink" class="btn-gray" target="_blank">
        <i class="bi bi-geo-alt-fill"></i> Lihat di Maps
      </a>
    </div>
  </div>
</div>


<!-- FAB -->
<button class="fab" id="scrollTopBtn" title="Kembali ke atas"><i class="bi bi-arrow-up"></i></button>

<script>
  // ====== UTIL ======
  const el = sel => document.querySelector(sel);
  const els = sel => document.querySelectorAll(sel);

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
    const belum = rows.filter(r => r.querySelector('.badge')?.textContent.includes('Belum')).length;
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

    const waMessage = `Halo ${data.nama}, pesanan Anda (${data.barang}) akan segera diantar. Mohon siapkan pembayaran (${data.pembayaran}). Terima kasih 🙏`;
    el('#whatsappLink').href = `https://wa.me/${data.hp.replace('+','')}?text=${encodeURIComponent(waMessage)}`;
    el('#mapLink').href = `https://www.google.com/maps?q=${encodeURIComponent(data.alamat)}`;

    modal.style.display = 'flex';
  }
  function closeModal(){ modal.style.display = 'none'; }
  modalClose.addEventListener('click', closeModal);
  window.addEventListener('click', (e)=>{ if(e.target === modal) closeModal(); });
  // Attach detail buttons
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
      // Hindari bind dobel
      if(btn.dataset.bound === '1') return;
      btn.dataset.bound = '1';

      btn.addEventListener('click', ()=>{
        Swal.fire({
          title: 'Yakin alamat sudah sesuai?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Selesai',
          cancelButtonText: 'Batal',
          confirmButtonColor: '#27ae60',
          cancelButtonColor: '#e74c3c'
        }).then(res=>{
          if(res.isConfirmed){
            const row = btn.closest('tr');
            const statusCell = row.querySelector('td:nth-child(6)');
            statusCell.innerHTML = '<span class="badge badge-done">Sudah Diantar</span>';
            recalcCounters();
            Swal.fire('Selesai!', 'Pengiriman telah ditandai selesai.', 'success');
            applyFilters(); // jaga konsistensi tampilan saat filter aktif
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
    const statusTxt = row.querySelector('.badge')?.textContent.trim() || '';
    return statusTxt === activeStatus;
  }
  function applyFilters(){
    const q = searchInput.value.trim();
    const rows = [...el('#tbody').querySelectorAll('tr')];
    rows.forEach((r,i)=>{
      const ok = rowMatchesSearch(r, q) && rowMatchesStatus(r);
      r.style.display = ok ? '' : 'none';
      // Renumber visible rows
      const noCell = r.querySelector('td:first-child');
      if(noCell) noCell.textContent = i+1;
      // For mobile cards: add data-label to td
      const labels = ['No.','Nama','Alamat','Barang','Tanggal Kirim','Status','Aksi'];
      r.querySelectorAll('td').forEach((td,idx)=> td.setAttribute('data-label', labels[idx] || ''));
    });
  }
  searchInput.addEventListener('input', applyFilters);
  resetBtn.addEventListener('click', ()=>{
    searchInput.value = '';
    activeStatus = 'ALL';
    el('#statusTabs').querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
    el('#statusTabs').querySelector('[data-status="ALL"]').classList.add('active');
    applyFilters();
  });

  // Tabs
  el('#statusTabs').querySelectorAll('.tab').forEach(tab=>{
    tab.addEventListener('click', ()=>{
      el('#statusTabs').querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
      tab.classList.add('active');
      activeStatus = tab.dataset.status;
      applyFilters();
    });
  });

  // ====== SORT TABLE ======
  let sortState = { key:null, dir:1 }; // 1 asc, -1 desc
  const keyIndex = { no:0, nama:1, alamat:2, barang:3, tanggal:4, status:5 };

  function parseDateId(text){
    // format contoh: "03 Agustus 2025"
    const map = {
      januari:0,februari:1,maret:2,april:3,mei:4,juni:5,
      juli:6,agustus:7,september:8,oktober:9,november:10,desember:11
    };
    const parts = text.trim().toLowerCase().split(' ');
    if(parts.length >= 3){
      const d = parseInt(parts[0],10)||1;
      const m = map[parts[1]] ?? 0;
      const y = parseInt(parts[2],10)||1970;
      return new Date(y,m,d).getTime();
    }
    return 0;
  }

  function sortBy(key){
    const ths = document.querySelectorAll('thead th');
    ths.forEach(th => th.style.textDecoration='none');

    if(sortState.key === key) sortState.dir *= -1;
    else { sortState.key = key; sortState.dir = 1; }

    const idx = keyIndex[key];
    const rows = Array.from(el('#tbody').rows);

    rows.sort((a,b)=>{
      const A = a.cells[idx]?.innerText.trim() || '';
      const B = b.cells[idx]?.innerText.trim() || '';
      if(key === 'tanggal'){
        return (parseDateId(A) - parseDateId(B)) * sortState.dir;
      }else if(key === 'status'){
        return A.localeCompare(B) * sortState.dir;
      }else if(key === 'no'){
        return (parseInt(A,10)-parseInt(B,10)) * sortState.dir;
      }else{
        return A.localeCompare(B, 'id') * sortState.dir;
      }
    });

    // Re-append rows
    rows.forEach((r,i)=>{
      r.cells[0].innerText = i+1;
      el('#tbody').appendChild(r);
    });

    // mark sorted column
    ths.forEach(th=>{
      if(th.dataset.key === key){
        th.style.textDecoration = 'underline';
      }
    });
  }

  document.querySelectorAll('thead th[data-key]').forEach(th=>{
    th.addEventListener('click', ()=> sortBy(th.dataset.key));
  });

  // ====== SCROLL TOP FAB ======
  const scrollBtn = el('#scrollTopBtn');
  scrollBtn.addEventListener('click', ()=> window.scrollTo({ top:0, behavior:'smooth' }));
  window.addEventListener('scroll', ()=>{
    scrollBtn.style.display = (window.scrollY > 300) ? 'grid' : 'none';
  });
  scrollBtn.style.display = 'none';

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