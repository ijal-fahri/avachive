<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pengaturan | Avachive</title>

    <!-- Google Fonts dan Bootstrap Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ecf0f1;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #14532d;
            /* hijau tua */
            color: #fff;
            padding: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            gap: 20px;
            transition: transform 0.3s ease;
            z-index: 998;
        }

        .sidebar h2 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #dcdde1;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #166534;
            /* hover hijau gelap */
        }

        .main-content {
            margin-left: 240px;
            padding: 40px 30px;
            width: calc(100% - 240px);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h3 {
            font-size: 26px;
            color: #2f3542;
            margin-bottom: 5px;
        }

        .header p {
            color: #636e72;
            font-size: 14px;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .card h4 {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #2f3542;
            cursor: pointer;
            user-select: none;
            margin-bottom: 10px;
        }

        .card h4 i {
            margin-right: 10px;
        }

        .toggle-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .rotate {
            transform: rotate(90deg);
        }

        .card-body {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
            display: none;
            line-height: 1.6;
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2980b9;
        }

        .profile-info h4 {
            margin: 0;
            font-size: 18px;
            color: #2f3542;
        }

        .profile-info p {
            font-size: 14px;
            color: #555;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            opacity: 0.9;
        }

        /* Toggle sidebar */
        #toggleMenu {
            display: none;
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #14532d;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 20px;
            z-index: 999;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            #toggleMenu:checked~.sidebar {
                transform: translateX(0);
            }

            .mobile-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .profile-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <input type="checkbox" id="toggleMenu" hidden />
    <label for="toggleMenu" class="mobile-toggle"><i class="bi bi-list"></i></label>

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Avachive</h2>
        <a href="/driver/dashboard"><i class="bi bi-box-seam"></i> Pengiriman</a>
        <a href="/driver/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a>
        <a href="/driver/pengaturan"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h3><i class="bi bi-gear"></i> Pengaturan</h3>
            <p>Informasi profil, tentang aplikasi, dan panduan penggunaan.</p>
        </div>

        <!-- Profil Driver -->
        <div class="card">
            <h4><i class="bi bi-person-circle"></i> Profil Driver</h4>
            <div class="profile-card">
                <img src="https://ui-avatars.com/api/?name=Rusqi+Yudha&background=2980b9&color=fff&size=128"
                    alt="Foto Profil">
                <div class="profile-info">
                    <h4>Rusqi Yudha Wastu</h4>
                    <p>rusqi@example.com</p>
                </div>
            </div>
        </div>

        <!-- Tentang Aplikasi -->
        <div class="card">
            <h4 onclick="toggleCard('infoApp', this)">
                <i class="bi bi-info-circle"></i> Tentang Aplikasi
                <span class="toggle-arrow bi bi-caret-right-fill"></span>
            </h4>
            <div id="infoApp" class="card-body">
                Avachive adalah aplikasi pengelolaan dan pengantaran laundry yang membantu driver mengelola tugas harian
                secara efisien. Dengan antarmuka yang sederhana dan informatif, aplikasi ini mempermudah proses
                pelacakan barang dan pengiriman ke pelanggan.
            </div>
        </div>

        <!-- Cara Penggunaan -->
        <div class="card">
            <h4 onclick="toggleCard('caraPakai', this)">
                <i class="bi bi-question-circle"></i> Cara Menggunakan Aplikasi
                <span class="toggle-arrow bi bi-caret-right-fill"></span>
            </h4>
            <div id="caraPakai" class="card-body">
                1. Masuk ke halaman <b>Pengiriman</b> untuk melihat daftar barang yang harus diantar.<br>
                2. Klik tombol <b>Detail</b> untuk melihat informasi lengkap barang.<br>
                3. Setelah barang dikirim, klik tombol <b>Selesai</b> untuk memindahkannya ke Riwayat.<br>
                4. Masuk ke halaman <b>Riwayat</b> untuk melihat barang yang sudah dikirim.<br>
                5. Gunakan menu <b>Pengaturan</b> untuk melihat profil dan panduan.
            </div>
        </div>

        <!-- Logout -->
        <div class="card">
            <h4><i class="bi bi-box-arrow-right"></i> Keluar</h4>
            <p>Klik tombol di bawah ini untuk keluar dari aplikasi.</p>
            <button class="btn-logout"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </div>
    </div>

    <!-- Script -->
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
