<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Laundry - Avachive</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* CSS-mu sudah bagus, tidak perlu diubah. */
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; }
        .admin-wrapper { display: flex; height: 100vh; overflow: hidden; }
        .sidebar { width: 250px; background: #1e272e; color: white; display: flex; flex-direction: column; padding: 1rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .topbar .user-info { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; color: #2f3640; }
        .dashboard-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.04); margin-bottom: 2rem; animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .dashboard-section h3 { margin-top: 0; font-weight: 600; color: #0984e3; }
        .stat-box { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.2rem; }
        .stat-card { background: #f1f2f6; padding: 1.5rem; border-radius: 14px; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
        .stat-card h4 { margin: 0; font-size: 1rem; color: #2d3436; font-weight: 500;}
        .stat-card p { font-size: 1.8rem; font-weight: 600; margin-top: 0.5rem; color: #0984e3; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        table, th, td { border: 1px solid #dcdde1; }
        th, td { padding: 0.75rem; text-align: left; }
        th { background-color: #0984e3; color: white; }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .line-chart { width: 100%; padding: 1rem 0; margin-top: 1rem; }
        .chart-row { display: flex; justify-content: space-around; align-items: flex-end; position: relative; height: 200px; border-left: 2px solid #ccc; border-bottom: 2px solid #ccc; padding: 0 1rem; }
        .point { position: relative; flex: 1; height: calc(var(--val, 0) * 1%); background-color: #0984e3; border-radius: 5px 5px 0 0; display: flex; align-items: flex-end; justify-content: center; transition: all 0.3s ease; cursor: pointer; margin: 0 0.5rem; }
        .point span { position: absolute; bottom: -25px; font-size: 0.85rem; color: #333; }
        .point:hover { background-color: #00cec9; }
        .point::before { content: attr(data-value); position: absolute; top: -25px; font-size: 0.75rem; background: #333; color: #fff; padding: 2px 6px; border-radius: 4px; display: none; white-space: nowrap; }
        .point:hover::before { display: block; }
        footer { text-align: center; padding: 1rem; font-size: 0.85rem; color: #888; }
        @media (max-width: 768px) { .admin-wrapper { flex-direction: column; } .sidebar { flex-direction: row; overflow-x: auto; width: 100%; padding: 0.5rem; } .sidebar a { flex: 1; justify-content: center; font-size: 0.9rem; } }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Avachive</h2>
            <a href="{{ route('dashboard') }}" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk') }}"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}#"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>

        <main class="main-content fade-in">
      <div class="topbar fade-in">
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mengambil data dari Controller yang sudah di-parsing ke format JSON
    const labels = @json($chart_labels);
    const data = @json($chart_data);

    // Konfigurasi Grafik
    const chartConfig = {
        type: 'line', // Tipe grafik adalah 'line' (kurva)
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Order',
                backgroundColor: 'rgba(9, 132, 227, 0.2)',
                borderColor: 'rgba(9, 132, 227, 1)',
                data: data,
                fill: true,
                borderWidth: 2,
                tension: 0.4 // Membuat kurva lebih halus
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false // Menyembunyikan legenda 'Jumlah Order' di atas
                }
            }
        }
    };

    // Membuat grafik baru di dalam canvas
    const myChart = new Chart(
        document.getElementById('orderChart'),
        chartConfig
    );
</script>
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
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->pelanggan->nama ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $layanan_items = json_decode($order->layanan, true) ?? [];
                                @endphp
                                @foreach($layanan_items as $item)
                                    <div>{{ $item['nama'] ?? '' }} ({{ $item['kuantitas'] ?? '' }}x)</div>
                                @endforeach
                            </td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $order->status ?? 'Baru' }}</td>
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
                &copy; {{ date('Y') }} Admin Laundry Rusqi. All rights reserved.
            </footer>
        </main>
    </div>
</body>
</html>