{{-- <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Panel - Avachive</title>
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
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
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
      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>
      <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'active' : '' }}">
        <i class="bi bi-box"></i> Produk
      </a>
      <a href="{{ route('dataorder') }}" class="{{ request()->routeIs('dataorder') ? 'active' : '' }}">
        <i class="bi bi-cart-check"></i> Order
      </a>
      <a href="{{ route('datauser') }}" class="{{ request()->routeIs('datauser') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Pengguna
      </a>
      <a href="{{ route('pengaturan') }}" class="{{ request()->routeIs('pengaturan') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> Pengaturan
      </a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="topbar">
        <div>Selamat Datang, Admin!</div>
        <div class="user-info">
          <i class="bi bi-person-circle fs-5"></i> Rusqi
        </div>
      </div>

      <section class="dashboard-section">
        <h3>Statistik Hari Ini</h3>
        <div class="stat-box">
          <div class="stat-card">
            <h4>Total Order</h4>
            <p>120</p>
          </div>
          <div class="stat-card">
            <h4>Pemasukan</h4>
            <p>Rp 5.400.000</p>
          </div>
          <div class="stat-card">
            <h4>Pengguna Baru</h4>
            <p>25</p>
          </div>
        </div>
      </section>

      <section class="dashboard-section">
        <h3>Aktivitas Terbaru</h3>
        <ul>
          <li>Order #1234 oleh Budi - <strong>Rp 450.000</strong></li>
          <li>Produk baru ditambahkan: <strong>iPhone 14 Pro</strong></li>
          <li>User baru terdaftar: <strong>aisyah@gmail.com</strong></li>
        </ul>
      </section>

      <footer>
        &copy; 2025 Admin Panel Rusqi. All rights reserved.
      </footer>
    </main>
  </div>
</body>
</html> --}}

<h1>mantap</h1>
