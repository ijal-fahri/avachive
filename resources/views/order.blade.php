<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Order Laundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; }
        .admin-wrapper { display: flex; height: 100vh; position: relative; overflow-x: hidden; }
        
        /* --- CSS Sidebar & Hamburger --- */
        .sidebar { 
            width: 250px; 
            background: #1e272e; 
            color: white; 
            display: flex; 
            flex-direction: column; 
            padding: 1rem;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
            flex-shrink: 0;
        }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; }
        
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .topbar .user-info { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; }
        
        /* --- CSS untuk Hamburger & Overlay --- */
        .hamburger-btn {
            display: none;
            font-size: 1.8rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #2f3640;
            line-height: 1;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* --- Sisa CSS --- */
        .filter-section, .table-section { background: #fff; padding: 2rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 6px 18px rgba(0,0,0,0.04); }
        .filter-section select { padding: 0.6rem 1rem; border-radius: 8px; border: 1px solid #ccc; margin: 0.5rem 0; font-family: 'Poppins'; }
        .month-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 0.75rem; margin-top: 1rem; }
        .month-button { padding: 0.6rem 1.2rem; border-radius: 8px; border: 1px solid #ccc; background: #fff; cursor: pointer; font-family: 'Poppins'; transition: all 0.3s ease; text-align: center; }
        .month-button:hover, .month-button.active { background: #00cec9; color: white; border-color: #00cec9; }
        .orders-table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
        th, td { padding: 0.75rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #f1f2f6; color: #2f3640; }
        .order-group { margin-bottom: 2rem; display: none; }
        .order-group-title { background: #dfe6e9; padding: 0.75rem 1rem; border-radius: 8px; font-weight: bold; color: #2f3542; margin-bottom: 0.5rem; }

        /* --- CSS UNTUK RESPONSIVE (DI-UPGRADE TOTAL) --- */
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
            .topbar { flex-direction: row; }
            .filter-section, .table-section { padding: 1rem; }
            
            /* CSS UNTUK TABEL MODEL STACKING */
            .orders-table { border: 0; }
            .orders-table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            .orders-table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }
            .orders-table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }
            .orders-table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            .orders-table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar" id="sidebar">
            <h2>Avachive</h2>
            <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}" class="active"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <button class="hamburger-btn" id="hamburgerBtn"><i class="bi bi-list"></i></button>
                <div>Data Order Laundry</div>
                <div class="user-info">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name ?? 'Admin' }}
                </div>
            </div>

            <section class="filter-section">
                <h3>Pilih Tahun & Bulan</h3>
                <label for="yearSelect">Tahun:</label>
                <select id="yearSelect">
                    @forelse($years as $year)
                        <option value="{{ $year }}" @if(now()->year == $year) selected @endif>{{ $year }}</option>
                    @empty
                        <option>Tidak ada data</option>
                    @endforelse
                </select>
                <div>
                    <strong>Pilih Bulan:</strong>
                    <div class="month-grid" id="monthButtons">
                        @php
                            $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                        @endphp
                        @foreach($months as $index => $month)
                            <button class="month-button" data-month="{{ $index + 1 }}">{{ $month }}</button>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="table-section">
                <h3>Data Order per Hari</h3>
                <div id="orderContent">
                    @forelse($order_groups as $tanggal => $grup)
                    <div class="order-group" data-date="{{ $tanggal }}" data-year="{{ \Carbon\Carbon::parse($tanggal)->format('Y') }}" data-month="{{ \Carbon\Carbon::parse($tanggal)->format('n') }}">
                        <div class="order-group-title">
                            Tanggal: {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Nama Customer</th>
                                    <th>Layanan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grup['orders'] as $order)
                                <tr class="sub-row">
                                    <td data-label="Customer">{{ $order['nama'] }}</td>
                                    <td data-label="Layanan">
                                        @php $layanan_items = json_decode($order['layanan'], true) ?? []; @endphp
                                        @foreach($layanan_items as $item)
                                        <div>
                                            {{ $item['nama'] ?? 'N/A' }} 
                                            <strong>({{ $item['kuantitas'] ?? 0 }}x)</strong>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td data-label="Total Harga">Rp {{ number_format($order['total_harga'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td data-label=" " colspan="2" style="text-align: left;"><strong>Total Pemasukan Harian</strong></td>
                                    <td data-label="Total Pemasukan"><strong>Rp {{ number_format($grup['total_pemasukan'], 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @empty
                    <p>Tidak ada data order yang bisa ditampilkan.</p>
                    @endforelse
                </div>
            </section>
        </main>
    </div>

    <div class="overlay" id="overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.getElementById('yearSelect');
            const monthButtons = document.querySelectorAll('.month-button');
            const orderGroups = document.querySelectorAll('.order-group');
            const orderContent = document.getElementById('orderContent');
            let noDataMessage = null;

            function filterOrders() {
                const selectedYear = yearSelect.value;
                const activeButton = document.querySelector('.month-button.active');
                
                if (!activeButton) return;

                const selectedMonth = activeButton.getAttribute('data-month');
                let hasVisibleData = false;

                orderGroups.forEach(group => {
                    const groupYear = group.getAttribute('data-year');
                    const groupMonth = group.getAttribute('data-month');

                    if (groupYear === selectedYear && groupMonth === selectedMonth) {
                        group.style.display = 'block';
                        hasVisibleData = true;
                    } else {
                        group.style.display = 'none';
                    }
                });

                if (!hasVisibleData) {
                    if (!noDataMessage) {
                        noDataMessage = document.createElement('p');
                        noDataMessage.textContent = 'Tidak ada data untuk periode yang dipilih.';
                        orderContent.appendChild(noDataMessage);
                    }
                    noDataMessage.style.display = 'block';
                } else {
                    if (noDataMessage) {
                        noDataMessage.style.display = 'none';
                    }
                }
            }

            monthButtons.forEach(button => {
                button.addEventListener('click', function() {
                    monthButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    filterOrders();
                });
            });

            yearSelect.addEventListener('change', filterOrders);

            // Auto select current month & year
            const currentMonth = new Date().getMonth() + 1;
            const currentYear = new Date().getFullYear().toString();

            if (yearSelect.querySelector(`option[value="${currentYear}"]`)) {
                yearSelect.value = currentYear;
            }

            const currentMonthButton = document.querySelector(`.month-button[data-month="${currentMonth}"]`);
            if (currentMonthButton) {
                currentMonthButton.click();
            } else if (monthButtons.length > 0) {
                // Jika tidak ada data di bulan ini, klik bulan pertama yang ada datanya
                const firstAvailableMonth = orderGroups.length > 0 ? orderGroups[0].getAttribute('data-month') : null;
                if(firstAvailableMonth) {
                    const firstMonthButton = document.querySelector(`.month-button[data-month="${firstAvailableMonth}"]`);
                    if(firstMonthButton) firstMonthButton.click();
                }
            }
        });
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