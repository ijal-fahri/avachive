<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Laundry - Avachive</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; }
        .admin-wrapper { display: flex; height: 100vh; position: relative; overflow-x: hidden; }
        
        /* --- CSS SIDEBAR & HAMBURGER --- */
        .sidebar { 
            width: 250px; background: #1e272e; color: white; display: flex; flex-direction: column; 
            padding: 1rem; transition: transform 0.3s ease-in-out; z-index: 1000; flex-shrink: 0;
        }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; }
        
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .topbar .user-info { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; color: #2f3640; }
        
        .hamburger-btn { display: none; font-size: 1.8rem; background: none; border: none; cursor: pointer; color: #2f3640; line-height: 1; }
        .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }

        /* --- CSS KONTEN ASLI (TIDAK DIUBAH) --- */
        .dashboard-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.04); margin-bottom: 2rem; }
        .dashboard-section h3 { margin-top: 0; font-weight: 600; color: #0984e3; }
        .stat-box { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.2rem; }
        .stat-card { background: #f1f2f6; padding: 1.5rem; border-radius: 14px; }
        .stat-card h4 { margin: 0; font-size: 1rem; color: #2d3436; font-weight: 500;}
        .stat-card p { font-size: 1.8rem; font-weight: 600; margin-top: 0.5rem; color: #0984e3; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f1f2f6; color: #2f3640; }
        footer { text-align: center; padding: 1rem; font-size: 0.85rem; color: #888; }

        /* --- CSS RESPONSIVE BARU (MENGGANTIKAN YANG LAMA) --- */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0; top: 0; height: 100%;
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .hamburger-btn {
                display: block;
            }
            .main-content { padding: 1rem; }
            .dashboard-section { padding: 1.5rem; }

            /* CSS untuk Tabel Stacking */
            table { border: 0; }
            table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px; }
            table tr { border-bottom: 3px solid #ddd; display: block; margin-bottom: .625em; }
            table td { border-bottom: 1px solid #ddd; display: block; font-size: .8em; text-align: right; }
            table td::before { content: attr(data-label); float: left; font-weight: bold; text-transform: uppercase; }
            table td:last-child { border-bottom: 0; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar" id="sidebar">
            <h2>Avachive</h2>
            <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <button class="hamburger-btn" id="hamburgerBtn"><i class="bi bi-list"></i></button>
                <div>Selamat Datang, Admin!</div>
                <div class="user-info">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                </div>
            </div>

            <section class="dashboard-section">
                <h3>Ringkasan Data</h3>
                <div class="stat-box">
                    <div class="stat-card"><h4>Pendapatan Tahun Ini</h4><p>Rp {{ number_format($pendapatan_tahun_ini, 0, ',', '.') }}</p></div>
                    <div class="stat-card"><h4>Pendapatan Bulan Ini</h4><p>Rp {{ number_format($pendapatan_bulan_ini, 0, ',', '.') }}</p></div>
                    <div class="stat-card"><h4>Total Order Tahun Ini</h4><p>{{ number_format($total_order_tahun_ini, 0, ',', '.') }}</p></div>
                    <div class="stat-card"><h4>Total Order Bulan Ini</h4><p>{{ number_format($total_order_bulan_ini, 0, ',', '.') }}</p></div>
                    <div class="stat-card"><h4>Jumlah Pelanggan</h4><p>{{ number_format($jumlah_pelanggan, 0, ',', '.') }}</p></div>
                    <div class="stat-card"><h4>Jumlah Layanan</h4><p>{{ $jumlah_layanan }}</p></div>
                </div>
            </section>

            <section class="dashboard-section">
                <h3>Statistik Pesanan Tahun {{ now()->year }}</h3>
                <div style="width: 100%; height: 250px;">
                    <canvas id="orderChart"></canvas>
                </div>
            </section>

            <section class="dashboard-section">
                <h3>Data Pesanan Hari Ini ({{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }})</h3>
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
                        @forelse ($pesanan_hari_ini as $order)
                        <tr>
                            <td data-label="ID Order">#{{ $order->id }}</td>
                            <td data-label="Nama">{{ $order->pelanggan->nama ?? 'N/A' }}</td>
                            <td data-label="Layanan">
                                @php $layanan_items = json_decode($order->layanan, true) ?? []; @endphp
                                @foreach($layanan_items as $item)
                                    <div>{{ $item['nama'] ?? '' }} ({{ $item['kuantitas'] ?? '' }}x)</div>
                                @endforeach
                            </td>
                            <td data-label="Total">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td data-label="Status">{{ $order->status ?? 'Baru' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak ada pesanan hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>

            <footer>
                &copy; {{ date('Y') }} Admin Laundry. All rights reserved.
            </footer>
        </main>
    </div>

    <div class="overlay" id="overlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($chart_labels);
        const data = @json($chart_data);
        const chartConfig = { type: 'line', data: { labels: labels, datasets: [{ label: 'Jumlah Order', backgroundColor: 'rgba(9, 132, 227, 0.2)', borderColor: 'rgba(9, 132, 227, 1)', data: data, fill: true, borderWidth: 2, tension: 0.4 }] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } } };
        const myChart = new Chart(document.getElementById('orderChart'), chartConfig);
    </script>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
        }

        hamburgerBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>