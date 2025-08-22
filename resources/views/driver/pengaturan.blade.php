<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pengaturan | Avachive</title>

  <!-- Google Fonts & Bootstrap Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f8f9fb;
      color: #333;
      margin: 0;
    }
    .admin-wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    /* ===== SIDEBAR ===== */
    .sidebar {
      width: 250px;
      background: #1e272e;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 1.5rem 1rem;
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 1.7rem;
      font-weight: 600;
      color: #00cec9;
      letter-spacing: 1px;
    }
    .sidebar a {
      color: #dcdde1;
      text-decoration: none;
      margin: 0.4rem 0;
      padding: 0.8rem 1rem;
      border-radius: 10px;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background: #00cec9;
      color: #fff;
      transform: translateX(5px);
    }

    /* ===== MAIN CONTENT ===== */
    .main-content {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
      background: #f4f6f9;
    }
    .topbar {
      background: #fff;
      padding: 1rem 2rem;
      border-radius: 14px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: #2f3640;
    }
    .topbar i {
      margin-right: 6px;
      color: #0984e3;
    }
    .topbar .user-info {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 500;
      color: #2f3640;
    }

    /* ===== SECTION ===== */
    .dashboard-section {
      background: white;
      padding: 1.8rem;
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.05);
      margin-bottom: 1.5rem;
      animation: fadeIn 0.4s ease-in-out;
      transition: all 0.3s ease;
    }
    .dashboard-section:hover {
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .dashboard-section h3 {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 1.15rem;
      margin-bottom: 1rem;
      color: #2f3542;
    }
    .dashboard-section h3 i {
      color: #00cec9;
    }

    /* Animasi Fade */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ===== PROFILE CARD ===== */
    .profile-card {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .profile-card img {
      width: 85px;
      height: 85px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #00cec9;
      box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }
    .profile-info h4 {
      margin: 0;
      font-size: 18px;
      font-weight: 600;
      color: #2f3542;
    }
    .profile-info p {
      font-size: 14px;
      color: #666;
    }

    /* ===== COLLAPSIBLE CARD ===== */
    .toggle-arrow {
      margin-left: auto;
      transition: transform 0.3s ease;
      color: #777;
    }
    .rotate { transform: rotate(90deg); }
    .card-body {
      font-size: 14px;
      color: #555;
      margin-top: 12px;
      display: none;
      line-height: 1.6;
      padding: 12px 16px;
      border-left: 3px solid #00cec9;
      background: #f9fafa;
      border-radius: 8px;
    }

    /* ===== LOGOUT BUTTON ===== */
    form button {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      padding: 12px 18px;
      border: none;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    form button:hover {
      background: linear-gradient(135deg, #c0392b, #a93226);
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(231,76,60,0.3);
    }

    /* ===== FOOTER ===== */
    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.85rem;
      color: #999;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .admin-wrapper { flex-direction: column; }
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
      .profile-card {
        flex-direction: column;
        text-align: center;
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
      <a href="/driver/dashboard" class="active"><i class="bi bi-box-seam"></i> Pengiriman</a>
      <a href="/driver/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a>
      <a href="/driver/pengaturan"><i class="bi bi-gear"></i> Pengaturan</a>
    </nav>
  </aside>
<div class=""></div>

  <!-- Main Content -->
  <main class="main-content">
    <div class="topbar">
      <div><i class="bi bi-gear"></i> Pengaturan</div>
      <div class="user-info">
        <i class="bi bi-person-circle fs-5"></i> Driver
      </div>
    </div>

    <!-- Profil Driver -->
    <section class="dashboard-section">
      <h3><i class="bi bi-person-circle"></i> Profil Driver</h3>
      <div class="profile-card">
        <img src="https://ui-avatars.com/api/?name=Rusqi+Yudha&background=2980b9&color=fff&size=128" alt="Foto Profil">
        <div class="profile-info">
          <h4>Rusqi Yudha Wastu</h4>
          <p>rusqi@example.com</p>
        </div>
      </div>
    </section>

    <!-- Tentang Aplikasi -->
    <section class="dashboard-section">
      <h3 onclick="toggleCard('infoApp', this)" style="cursor:pointer;">
        <i class="bi bi-info-circle"></i> Tentang Aplikasi
        <span class="toggle-arrow bi bi-caret-right-fill"></span>
      </h3>
      <div id="infoApp" class="card-body">
        Avachive adalah aplikasi pengelolaan dan pengantaran laundry yang membantu driver mengelola tugas harian
        secara efisien. Dengan antarmuka yang sederhana dan informatif, aplikasi ini mempermudah proses
        pelacakan barang dan pengiriman ke pelanggan.
      </div>
    </section>

    <!-- Cara Penggunaan -->
    <section class="dashboard-section">
      <h3 onclick="toggleCard('caraPakai', this)" style="cursor:pointer;">
        <i class="bi bi-question-circle"></i> Cara Menggunakan Aplikasi
        <span class="toggle-arrow bi bi-caret-right-fill"></span>
      </h3>
      <div id="caraPakai" class="card-body">
        1. Masuk ke halaman <b>Pengiriman</b> untuk melihat daftar barang yang harus diantar.<br>
        2. Klik tombol <b>Detail</b> untuk melihat informasi lengkap barang.<br>
        3. Setelah barang dikirim, klik tombol <b>Selesai</b> untuk memindahkannya ke Riwayat.<br>
        4. Masuk ke halaman <b>Riwayat</b> untuk melihat barang yang sudah dikirim.<br>
        5. Gunakan menu <b>Pengaturan</b> untuk melihat profil dan panduan.
      </div>
    </section>

    <!-- Logout -->
    <section class="dashboard-section">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" width="20" height="20">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Keluar
        </button>
      </form>
    </section>

    <footer>
      &copy; 2025 Avachive Driver. All rights reserved.
    </footer>
  </main>
</div>

<script>
  function toggleCard(id, header) {
    const content = document.getElementById(id);
    const arrow = header.querySelector('.toggle-arrow');
    const isVisible = content.style.display === 'block';
    content.style.display = isVisible ? 'none' : 'block';
    arrow.classList.toggle('rotate', !isVisible);
  }
</script>

</body>
</html>