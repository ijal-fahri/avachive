@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pengaturan - Admin Panel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #f5f6fa;
      color: #333;
    }

    .fade-in {
      animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
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
      flex-shrink: 0;
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
    }

    .settings-container {
      max-width: 1000px;
      margin: 0 auto;
    }

    .settings-section {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.04);
      margin-bottom: 2rem;
    }

    .settings-section h3 {
      margin-top: 0;
      font-weight: 600;
      color: #0984e3;
      margin-bottom: 1.5rem;
    }

    .profile-info {
      display: flex;
      gap: 1.5rem;
      align-items: center;
      margin-bottom: 2rem;
    }

    .profile-info img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile-info div {
      font-size: 0.95rem;
    }

    .profile-info div strong {
      display: block;
      font-size: 1.2rem;
      color: #2f3640;
    }

    .logout-btn {
      display: inline-block;
      background: #e84118;
      color: white;
      padding: 0.6rem 1.2rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
      text-decoration: none;
    }

    .logout-btn:hover {
      background: #c23616;
    }

    .info-text {
      font-size: 0.95rem;
      line-height: 1.6;
      color: #555;
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

      .profile-info {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Avachive</h2>
      <a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
      <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
      <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
      <a href="{{ route('pengaturan') }}" class="active"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content fade-in">
      <div class="topbar fade-in">
        <div>Pengaturan</div>
        <div class="user-info">
          <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
        </div>
      </div>

      <div class="settings-container fade-in">
        <!-- Profil -->
        <section class="settings-section">
          <h3>Profil Anda</h3>
          <div class="profile-info">
            <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&size=150' }}" alt="Foto Profil">
            <div>
              <strong>{{ Auth::user()->name }}</strong>
              <p>Role: {{ ucfirst(Auth::user()->usertype) }}</p>
            </div>
          </div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </section>

        <!-- Cara Penggunaan -->
        <section class="settings-section fade-in">
          <h3>Cara Menggunakan Aplikasi</h3>
          <p class="info-text">
            - Gunakan halaman <strong>Layanan</strong> untuk menambah atau mengatur jenis laundry.<br>
            - Gunakan halaman <strong>Order</strong> untuk melihat dan mengelola transaksi pelanggan.<br>
            - Gunakan halaman <strong>Pengguna</strong> untuk menambahkan atau mengedit data karyawan.<br>
            - Gunakan halaman <strong>Pengaturan</strong> untuk mengelola profil Anda dan logout dari sistem.
          </p>
        </section>

        <!-- Tentang Aplikasi -->
        <section class="settings-section fade-in">
          <h3>Tentang Aplikasi</h3>
          <p class="info-text">
            Aplikasi ini dibuat untuk membantu pemilik laundry dalam mengelola operasional harian secara efisien dan profesional.
            Dikembangkan oleh <strong>My Team</strong> sebagai bagian dari sistem administrasi digital laundry modern.
          </p>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
