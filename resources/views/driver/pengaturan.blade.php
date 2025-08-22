<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengaturan | Avachive</title>

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

    /* Kelas utilitas untuk rotasi arrow, dikontrol oleh JS */
    .rotate {
      transform: rotate(90deg);
    }
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
      <a href="/driver/riwayat" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
        <i class="bi bi-clock-history"></i> Riwayat
      </a>
      <a href="/driver/pengaturan" class="active flex items-center gap-3 px-4 py-3 rounded-lg text-white bg-teal-500 font-semibold transition-colors">
        <i class="bi bi-gear"></i> Pengaturan
      </a>
    </nav>
  </aside>

  <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
    <div class="sticky top-0 z-10 bg-white/80 backdrop-blur-sm border border-slate-200/60 p-4 rounded-xl shadow-lg mb-6 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <span class="text-2xl">⚙️</span>
        <div>
          <h1 class="font-semibold text-slate-800">Pengaturan Akun</h1>
          <p class="text-xs text-slate-500">Profil & Informasi Aplikasi</p>
        </div>
      </div>
      <div class="flex items-center gap-3">
        <span class="font-semibold text-sm hidden sm:inline">Driver</span>
        <i class="bi bi-person-circle text-2xl text-slate-600"></i>
      </div>
    </div>

    <section class="bg-white rounded-2xl shadow-lg p-6 mb-6">
      <h3 class="flex items-center gap-3 text-xl font-semibold text-slate-800 mb-4">
        <i class="bi bi-person-circle text-teal-500"></i>
        Profil Driver
      </h3>
      <div class="flex flex-col items-center text-center md:flex-row md:text-left gap-6">
        <img src="https://ui-avatars.com/api/?name=Rusqi+Yudha&background=3498db&color=fff&size=128&bold=true" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-teal-400 shadow-md">
        <div class="profile-info">
          <h4 class="text-2xl font-bold text-slate-900">Rusqi Yudha Wastu</h4>
          <p class="text-slate-500 mt-1">rusqi@example.com</p>
        </div>
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow-lg p-6 mb-6">
      <h3 onclick="toggleCard('infoApp', this)" class="flex justify-between items-center text-xl font-semibold text-slate-800 cursor-pointer">
        <div class="flex items-center gap-3">
          <i class="bi bi-info-circle text-teal-500"></i>
          Tentang Aplikasi
        </div>
        <span class="toggle-arrow bi bi-caret-right-fill text-slate-500 transition-transform"></span>
      </h3>
      <div id="infoApp" class="card-body hidden mt-4 pl-5 border-l-4 border-teal-400 text-slate-600 text-sm leading-relaxed">
        Avachive adalah aplikasi pengelolaan dan pengantaran laundry yang membantu driver mengelola tugas harian secara efisien. Dengan antarmuka yang sederhana dan informatif, aplikasi ini mempermudah proses pelacakan barang dan pengiriman ke pelanggan.
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow-lg p-6 mb-6">
      <h3 onclick="toggleCard('caraPakai', this)" class="flex justify-between items-center text-xl font-semibold text-slate-800 cursor-pointer">
        <div class="flex items-center gap-3">
          <i class="bi bi-question-circle text-teal-500"></i>
          Cara Menggunakan Aplikasi
        </div>
        <span class="toggle-arrow bi bi-caret-right-fill text-slate-500 transition-transform"></span>
      </h3>
      <div id="caraPakai" class="card-body hidden mt-4 pl-5 border-l-4 border-teal-400 text-slate-600 text-sm leading-relaxed">
        <ol class="list-decimal list-inside space-y-2">
            <li>Masuk ke halaman <b class="font-semibold text-slate-700">Pengiriman</b> untuk melihat daftar barang yang harus diantar.</li>
            <li>Klik tombol <b class="font-semibold text-slate-700">Detail</b> untuk melihat informasi lengkap pelanggan.</li>
            <li>Setelah barang dikirim, klik tombol <b class="font-semibold text-slate-700">Selesai</b> untuk memindahkannya ke Riwayat.</li>
            <li>Masuk ke halaman <b class="font-semibold text-slate-700">Riwayat</b> untuk melihat barang yang sudah dikirim.</li>
            <li>Gunakan menu <b class="font-semibold text-slate-700">Pengaturan</b> untuk melihat profil dan panduan ini.</li>
        </ol>
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow-lg p-6">
       <h3 class="flex items-center gap-3 text-xl font-semibold text-slate-800 mb-4">
        <i class="bi bi-box-arrow-right text-teal-500"></i>
        Keluar
      </h3>
      <p class="text-sm text-slate-600 mb-4">Anda akan keluar dari sesi ini dan perlu login kembali untuk mengakses dashboard.</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-br from-red-600 to-red-700 text-white font-semibold shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
          <i class="bi bi-box-arrow-right"></i>
          Keluar dari Akun
        </button>
      </form>
    </section>

    <footer class="text-center py-6 text-sm text-slate-500">
      © 2025 Avachive Driver. All rights reserved.
    </footer>
  </main>
  
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-slate-900 text-slate-300 p-2 flex justify-around shadow-lg">
      <a href="/driver/dashboard" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-box-seam text-xl"></i><span class="text-xs">Pengiriman</span>
      </a>
      <a href="/driver/riwayat" class="flex flex-col items-center justify-center hover:text-white p-2 rounded-lg w-full">
        <i class="bi bi-clock-history text-xl"></i><span class="text-xs">Riwayat</span>
      </a>
      <a href="/driver/pengaturan" class="active flex flex-col items-center justify-center text-teal-400 p-2 rounded-lg w-full">
        <i class="bi bi-gear text-xl"></i><span class="text-xs">Pengaturan</span>
      </a>
  </nav>

</div>

<script>
  function toggleCard(id, header) {
    const content = document.getElementById(id);
    const arrow = header.querySelector('.toggle-arrow');
    const isVisible = !content.classList.contains('hidden');

    if (isVisible) {
      content.classList.add('hidden');
      arrow.classList.remove('rotate');
    } else {
      content.classList.remove('hidden');
      arrow.classList.add('rotate');
    }
  }
</script>

</body>
</html>