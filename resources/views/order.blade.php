<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Order Laundry</title>
  
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

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
    .month-button:hover,
    .month-button.active {
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
      display: none;
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
      <a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
      <a href="{{ route('dataorder') }}" class="active"><i class="bi bi-cart-check"></i> Order</a>
      <a href="{{ route('datauser') }}"><i class="bi bi-people"></i> Karyawan</a>
      <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Topbar -->
      <div class="topbar">
        <div>Data Order Laundry</div>
        <div class="user-info">
          <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name ?? 'Admin' }}
        </div>
      </div>

      <!-- Filter Section -->
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

      <!-- Table Section -->
      <section class="table-section">
        <h3>Data Order per Hari</h3>
        <div id="orderContent">
          @forelse($order_groups as $tanggal => $grup)
            <div class="order-group"
                 data-date="{{ $tanggal }}"
                 data-year="{{ \Carbon\Carbon::parse($tanggal)->format('Y') }}"
                 data-month="{{ \Carbon\Carbon::parse($tanggal)->format('n') }}">
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
            <td>{{ $order['nama'] }}</td>
            <td>
                @php
                    // Mengubah teks JSON menjadi array yang bisa dibaca PHP
                    $layanan_items = json_decode($order['layanan'], true) ?? [];
                @endphp

                @foreach($layanan_items as $item)
                    <div>
                        {{ $item['nama'] ?? 'N/A' }} 
                        <strong>({{ $item['kuantitas'] ?? 0 }}x)</strong>
                    </div>
                @endforeach
            </td>
            <td>Rp {{ number_format($order['total_harga'], 0, ',', '.') }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2"><strong>Total Pemasukan Harian</strong></td>
        <td><strong>Rp {{ number_format($grup['total_pemasukan'], 0, ',', '.') }}</strong></td>
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

  <!-- Script -->
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
        monthButtons[0].click();
      }
    });
  </script>
</body>
</html>
