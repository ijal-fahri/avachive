<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Driver | Avachive</title>

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
        }

        /* Sidebar Hijau Tua */
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
            padding: 30px;
            width: calc(100% - 240px);
        }

        .header {
            margin-bottom: 20px;
        }

        .header h3 {
            font-size: 24px;
            color: #2f3542;
        }

        .info-boxes {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            flex: 1;
            text-align: center;
        }

        .info-box h4 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #57606f;
        }

        .info-box p {
            font-size: 20px;
            font-weight: 600;
            color: #2f3542;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        .card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .card th,
        .card td {
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid #dfe4ea;
            font-size: 14px;
        }

        .card th {
            background-color: #f1f2f6;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        .badge-pending {
            background-color: #e67e22;
        }

        .badge-done {
            background-color: #2ecc71;
        }

        .action-btn {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 6px 12px;
            font-size: 13px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-detail {
            background-color: #2980b9;
            color: white;
        }

        .btn-done {
            background-color: #27ae60;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            color: #888;
            cursor: pointer;
        }

        .service-box {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        .btn-green,
        .btn-gray {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-green {
            background-color: #2ecc71;
            color: white;
        }

        .btn-gray {
            background-color: #dfe4ea;
            color: #2d3436;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        /* Mobile Toggle Sidebar */
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
                z-index: 998;
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

            .info-boxes {
                flex-direction: column;
            }

            .card table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
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
            <h3>📦 Barang Siap Antar</h3>
            <p>Daftar pengiriman hari ini.</p>
        </div>

        <div class="info-boxes">
            <div class="info-box">
                <h4>Belum Diantar Hari Ini</h4>
                <p id="countBelum">0</p>
            </div>
            <div class="info-box">
                <h4>Sudah Diantar Hari Ini</h4>
                <p id="countSudah">0</p>
            </div>
        </div>

        <div class="card">
            <table id="tablePengiriman">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbodyPengiriman"></tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <h4>Detail Order</h4>
            <div id="detailContent"></div>
        </div>
    </div>

    <script>
        const dataPengiriman = [{
                nama: "Fadlan",
                hp: "+6285xxxx",
                alamat: "Ciomas",
                alamatLengkap: "Jawa Barat, Bogor, Ciomas",
                layanan: "Cuci Sepatu",
                kategori: "Satuan",
                harga: 80000,
                jumlah: 1,
                subtotal: 80000,
                status: "Belum Diantar",
                waktuBayar: "Bayar Sekarang",
                waktuOrder: "04-08-2025 09:30",
                pembayaran: "NonTunai",
                pengambilan: "Ambil Sendiri"
            },
            {
                nama: "Dewi",
                hp: "+6285xxxx",
                alamat: "Bogor Utara",
                alamatLengkap: "Bogor Utara, Jawa Barat",
                layanan: "Setrika Baju",
                kategori: "Kiloan",
                harga: 15000,
                jumlah: 2,
                subtotal: 30000,
                status: "Sudah Diantar",
                waktuBayar: "Bayar Dulu",
                waktuOrder: "04-08-2025 08:00",
                pembayaran: "Tunai",
                pengambilan: "Diantar"
            }
        ];

        const tbody = document.getElementById("tbodyPengiriman");
        const countBelum = document.getElementById("countBelum");
        const countSudah = document.getElementById("countSudah");

        let no = 1,
            totalBelum = 0,
            totalSudah = 0;

        dataPengiriman.forEach((data) => {
            if (data.status === "Belum Diantar") {
                const tr = document.createElement("tr");
                tr.innerHTML = `
          <td>${no++}</td>
          <td>${data.nama}</td>
          <td>${data.alamat}</td>
          <td>${data.layanan}</td>
          <td><span class="badge badge-pending">${data.status}</span></td>
          <td class="action-btn">
            <button class="btn btn-detail"
              data-nama="${data.nama}" data-hp="${data.hp}" data-alamat="${data.alamat}"
              data-alamat-lengkap="${data.alamatLengkap}" data-pengambilan="${data.pengambilan}"
              data-pembayaran="${data.pembayaran}" data-waktu-bayar="${data.waktuBayar}"
              data-waktu-order="${data.waktuOrder}" data-layanan="${data.layanan}"
              data-kategori="${data.kategori}" data-harga="${data.harga}" data-jumlah="${data.jumlah}"
              data-subtotal="${data.subtotal}"
            ><i class="bi bi-eye"></i> Detail</button>
            <button class="btn btn-done"><i class="bi bi-check2-circle"></i> Selesai</button>
          </td>`;
                tbody.appendChild(tr);
                totalBelum++;
            } else {
                totalSudah++;
            }
        });

        countBelum.textContent = totalBelum;
        countSudah.textContent = totalSudah;

        const modal = document.getElementById('detailModal');
        const detailContent = document.getElementById('detailContent');

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const data = btn.dataset;
                const total = parseInt(data.harga) * parseInt(data.jumlah);

                detailContent.innerHTML = `
          <p><strong>Nama:</strong> ${data.nama}</p>
          <p><strong>No HP:</strong> ${data.hp}</p>
          <p><strong>Alamat:</strong> ${data.alamat}</p>
          <p><strong>Alamat Lengkap:</strong> ${data.alamatLengkap}</p>
          <p><strong>Pengambilan:</strong> ${data.pengambilan}</p>
          <p><strong>Pembayaran:</strong> ${data.pembayaran}</p>
          <p><strong>Waktu Bayar:</strong> ${data.waktuBayar}</p>
          <p><strong>Waktu Order:</strong> ${data.waktuOrder}</p>
          <div class="service-box">
            ${data.layanan}<br/>
            Kategori: ${data.kategori}<br/>
            Harga: Rp ${parseInt(data.harga).toLocaleString()}<br/>
            Jumlah: ${data.jumlah}<br/>
            Subtotal: Rp ${parseInt(data.subtotal).toLocaleString()}
          </div>
          <p><strong>Total:</strong> Rp ${total.toLocaleString()}</p>
          <div class="button-group">
            <button class="btn-green"><i class="bi bi-whatsapp"></i> WhatsApp</button>
            <a href="https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.alamatLengkap)}"
              class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i> Buka Maps</a>
          </div>
        `;
                modal.style.display = "flex";
            });
        });

        function closeModal() {
            modal.style.display = "none";
        }

        window.onclick = function(e) {
            if (e.target === modal) closeModal();
        }
    </script>

</body>

</html>
