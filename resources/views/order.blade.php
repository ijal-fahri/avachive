<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Order Laundry</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #f4f7fc;
      color: #333;
    }

    .admin-wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

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

    .main-content {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }

    .topbar {
      background: #fff;
      padding: 1rem 2rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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

    .filter-section,
    .table-section {
      background: #fff;
      padding: 2rem;
      border-radius: 16px;
      margin-bottom: 2rem;
      box-shadow: 0 6px 18px rgba(0,0,0,0.04);
    }

    .filter-section select {
      padding: 0.6rem 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin: 0.5rem 0;
      font-family: 'Poppins';
    }

    .month-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 0.75rem;
      margin-top: 1rem;
    }

    .month-button {
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      background: #fff;
      cursor: pointer;
      font-family: 'Poppins';
      transition: all 0.3s ease;
      text-align: center;
    }

    .month-button:hover {
      background: #00cec9;
      color: white;
      border-color: #00cec9;
    }

    .orders-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    th, td {
      padding: 0.75rem;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background-color: #f1f2f6;
      color: #2f3640;
    }

    .sub-row {
      background: #f9fbff;
    }

    .sub-row td {
      padding-left: 2rem;
      color: #555;
      font-size: 0.9rem;
    }

    .order-group {
      margin-bottom: 2rem;
    }

    .order-group-title {
      background: #dfe6e9;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      font-weight: bold;
      color: #2f3542;
      margin-bottom: 0.5rem;
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
    <aside class="sidebar">
      <h2>Avachive</h2>
      <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="{{ route('produk') }}"><i class="bi bi-list-check"></i> Layanan</a>
      <a href="{{ route('dataorder') }}" class="active"><i class="bi bi-cart-check"></i> Order</a>
      <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Pengguna</a>
      <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="topbar">
        <div>Data Order Laundry</div>
        <div class="user-info">
          <i class="bi bi-person-circle"></i> Rusqi
        </div>
      </div>

      <section class="filter-section">
        <h3>Pilih Tahun & Bulan</h3>
        <label for="yearSelect">Tahun:</label>
        <select id="yearSelect">
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024" selected>2024</option>
          <option value="2025">2025</option>
        </select>

        <div><strong>Pilih Bulan:</strong>
          <div class="month-grid" id="monthButtons"></div>
        </div>
      </section>

      <section class="table-section">
        <h3>Data Order per Hari</h3>
        <div id="orderContent">
          <p>Pilih bulan untuk melihat data.</p>
        </div>
      </section>
    </main>
  </div>

  <script>
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const customers = ["Budi", "Sari", "Eko", "Linda", "Andi", "Nina", "Joko", "Tari"];

    const monthButtonsContainer = document.getElementById('monthButtons');
    const orderContent = document.getElementById('orderContent');

    function renderMonthButtons() {
      months.forEach((month, index) => {
        const btn = document.createElement('button');
        btn.className = 'month-button';
        btn.textContent = month;
        btn.onclick = () => loadDummyData(index + 1);
        monthButtonsContainer.appendChild(btn);
      });
    }

    function loadDummyData(month) {
      const year = document.getElementById('yearSelect').value;
      const totalDays = 10 + Math.floor(Math.random() * 10);
      let html = '';

      for (let day = 1; day <= totalDays; day++) {
        const orderCount = Math.floor(Math.random() * 4) + 1;
        let subRows = '';
        let totalIncome = 0;

        for (let i = 0; i < orderCount; i++) {
          const name = customers[Math.floor(Math.random() * customers.length)];
          const total = 5000 + Math.floor(Math.random() * 15000);
          totalIncome += total;
          subRows += `<tr class="sub-row"><td colspan="2">${name}</td><td>Rp ${total.toLocaleString('id-ID')}</td></tr>`;
        }

        html += `
          <div class="order-group">
            <div class="order-group-title">Tanggal: ${day.toString().padStart(2, '0')}-${month.toString().padStart(2, '0')}-${year}</div>
            <table class="orders-table">
              <thead><tr><th>Customer</th><th></th><th>Total Harga</th></tr></thead>
              <tbody>
                ${subRows}
                <tr><td colspan="2"><strong>Total Pemasukan</strong></td><td><strong>Rp ${totalIncome.toLocaleString('id-ID')}</strong></td></tr>
              </tbody>
            </table>
          </div>`;
      }

      orderContent.innerHTML = html;
    }

    renderMonthButtons();
  </script>
</body>
</html>
