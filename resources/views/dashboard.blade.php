<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Laundry - Avachive</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

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
    }

    .stat-box {
      display: flex;
      justify-content: space-between;
      gap: 1.2rem;
      flex-wrap: wrap;
    }

    .stat-card {
      flex: 1;
      min-width: 220px;
      background: #dfe6e9;
      padding: 1.5rem;
      border-radius: 14px;
      box-shadow: 0 3px 12px rgba(0,0,0,0.03);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      cursor: pointer;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      background: #b2bec3;
    }

    .stat-card h4 {
      margin: 0;
      font-size: 1.1rem;
      color: #2d3436;
    }

    .stat-card p {
      font-size: 1.8rem;
      font-weight: 700;
      margin-top: 0.5rem;
      color: #0984e3;
    }

    /* TABEL */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    table, th, td {
      border: 1px solid #dcdde1;
    }

    th, td {
      padding: 0.75rem;
      text-align: left;
    }

    th {
      background-color: #0984e3;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f1f2f6;
    }

    /* LINE CHART HTML-CSS */
    .line-chart {
      width: 100%;
      padding: 1rem 0;
      margin-top: 1rem;
    }

    .chart-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      position: relative;
      height: 200px;
      border-left: 2px solid #ccc;
      border-bottom: 2px solid #ccc;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .point {
      position: relative;
      width: 50px;
      height: calc(var(--val, 0) * 1%);
      background-color: #0984e3;
      border-radius: 10px 10px 0 0;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .point span {
      position: absolute;
      bottom: -25px;
      font-size: 0.85rem;
      color: #333;
    }

    .point:hover {
      background-color: #00cec9;
    }

    .point::before {
      content: attr(data-value);
      position: absolute;
      top: -25px;
      font-size: 0.75rem;
      background: #0984e3;
      color: #fff;
      padding: 2px 6px;
      border-radius: 4px;
      display: none;
    }

    .point:hover::before {
      display: block;
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
    <aside class="sidebar">
      <h2>Avachive</h2>
      <a href="{{ route('dashboard') }}"class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="{{ route('produk') }}" ><i class="bi bi-list-check"></i> Layanan</a>
      <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
      <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Pengguna</a>
      <a href="{{ route('pengaturan') }}" ><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="topbar">
        <div>Selamat Datang, Admin Laundry!</div>
        <div class="user-info">
          <i class="bi bi-person-circle fs-5"></i> Rusqi
        </div>
      </div>

      <!-- Ringkasan -->
      <section class="dashboard-section">
        <h3>Ringkasan Data</h3>
        <div class="stat-box">
          <div class="stat-card"><h4>Pendapatan Tahun Ini</h4><p>Rp 72.000.000</p></div>
          <div class="stat-card"><h4>Pendapatan Bulan Ini</h4><p>Rp 6.000.000</p></div>
          <div class="stat-card"><h4>Total Order Tahun Ini</h4><p>1.200</p></div>
          <div class="stat-card"><h4>Total Order Bulan Ini</h4><p>130</p></div>
          <div class="stat-card"><h4>Jumlah Pelanggan</h4><p>320</p></div>
          <div class="stat-card"><h4>Jumlah Layanan</h4><p>8</p></div>
        </div>
      </section>

      <!-- Kurva Statistik -->
      <section class="dashboard-section">
        <h3>Statistik Pesanan per Tahun</h3>
        <div class="line-chart">
          <div class="chart-row">
            <div class="point" style="--val: 60;" data-value="890 Order"><span>2020</span></div>
            <div class="point" style="--val: 80;" data-value="1050 Order"><span>2021</span></div>
            <div class="point" style="--val: 95;" data-value="1180 Order"><span>2022</span></div>
            <div class="point" style="--val: 100;" data-value="1200 Order"><span>2023</span></div>
            <div class="point" style="--val: 85;" data-value="1120 Order"><span>2024</span></div>
          </div>
        </div>
      </section>

      <!-- Tabel Pesanan Hari Ini -->
      <section class="dashboard-section">
        <h3>Data Pesanan Hari Ini</h3>
        <table>
          <thead>
            <tr>
              <th>ID Order</th>
              <th>Nama</th>
              <th>Layanan</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#202501</td>
              <td>Budi</td>
              <td>Cuci Kering</td>
              <td>Rp 35.000</td>
              <td>Selesai</td>
            </tr>
            <tr>
              <td>#202502</td>
              <td>Sari</td>
              <td>Setrika</td>
              <td>Rp 25.000</td>
              <td>Proses</td>
            </tr>
            <tr>
              <td>#202503</td>
              <td>Eko</td>
              <td>Cuci Komplit</td>
              <td>Rp 50.000</td>
              <td>Menunggu</td>
            </tr>
          </tbody>
        </table>
      </section>

      <footer>
        &copy; 2025 Admin Laundry Rusqi. All rights reserved.
      </footer>
    </main>
  </div>
</body>
</html>
