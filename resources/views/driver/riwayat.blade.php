<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Pengiriman | Avachive</title>

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
            /* hover hijau tua lebih terang */
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            width: calc(100% - 240px);
        }

        .header {
            margin-bottom: 30px;
        }

        .header h3 {
            font-size: 24px;
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
            min-width: 700px;
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

        .badge-done {
            background-color: #2ecc71;
        }

        .btn {
            padding: 6px 12px;
            font-size: 13px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
            background-color: #3498db;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Modal */
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

        .detail-box {
            background-color: #f1f2f6;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .detail-box p {
            margin: 4px 0;
            font-size: 14px;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-green,
        .btn-gray {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-green {
            background-color: #2ecc71;
            color: white;
        }

        .btn-gray {
            background-color: #dfe4ea;
            color: #2d3436;
        }

        /* Sidebar Toggle */
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
            <h3>🕒 Riwayat Pengiriman</h3>
            <p>Daftar pengiriman barang yang telah selesai dilakukan oleh driver.</p>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Barang</th>
                        <th>Tanggal Kirim</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Andi Saputra</td>
                        <td>Jl. Anggrek No. 12, Bogor</td>
                        <td>Kemeja Laundry</td>
                        <td>03 Agustus 2025</td>
                        <td><span class="badge badge-done">Terkirim</span></td>
                        <td>
                            <button class="btn btn-detail" data-nama="Andi Saputra" data-hp="+628123456789"
                                data-alamat="Jl. Anggrek No. 12, Bogor" data-barang="Kemeja Laundry"
                                data-metode="Diantar" data-pembayaran="Tunai" data-tanggal="03 Agustus 2025"><i
                                    class="bi bi-eye"></i> Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Aminah</td>
                        <td>Perumahan Citra Asri Blok B2</td>
                        <td>Seprai + Gorden</td>
                        <td>02 Agustus 2025</td>
                        <td><span class="badge badge-done">Terkirim</span></td>
                        <td>
                            <button class="btn btn-detail" data-nama="Siti Aminah" data-hp="+628777888999"
                                data-alamat="Perumahan Citra Asri Blok B2" data-barang="Seprai + Gorden"
                                data-metode="Diantar" data-pembayaran="Transfer" data-tanggal="02 Agustus 2025"><i
                                    class="bi bi-eye"></i> Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <h4>Detail Pengiriman</h4>
            <div class="detail-box">
                <p><strong>Nama:</strong> <span id="modalNama"></span></p>
                <p><strong>No HP:</strong> <span id="modalHp"></span></p>
                <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                <p><strong>Barang:</strong> <span id="modalBarang"></span></p>
                <p><strong>Metode Pengiriman:</strong> <span id="modalMetode"></span></p>
                <p><strong>Pembayaran:</strong> <span id="modalPembayaran"></span></p>
                <p><strong>Tanggal Kirim:</strong> <span id="modalTanggal"></span></p>
            </div>
            <div class="button-group">
                <a href="#" id="whatsappLink" class="btn-green" target="_blank"><i class="bi bi-whatsapp"></i>
                    WhatsApp</a>
                <a href="#" id="mapLink" class="btn-gray" target="_blank"><i class="bi bi-geo-alt-fill"></i>
                    Lihat di Maps</a>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const detailButtons = document.querySelectorAll('.btn-detail');
        const modal = document.getElementById('detailModal');
        const modalNama = document.getElementById('modalNama');
        const modalHp = document.getElementById('modalHp');
        const modalAlamat = document.getElementById('modalAlamat');
        const modalBarang = document.getElementById('modalBarang');
        const modalMetode = document.getElementById('modalMetode');
        const modalPembayaran = document.getElementById('modalPembayaran');
        const modalTanggal = document.getElementById('modalTanggal');
        const mapLink = document.getElementById('mapLink');
        const whatsappLink = document.getElementById('whatsappLink');

        detailButtons.forEach(button => {
            button.addEventListener('click', () => {
                const nama = button.dataset.nama;
                const hp = button.dataset.hp;
                const alamat = button.dataset.alamat;
                const barang = button.dataset.barang;
                const metode = button.dataset.metode;
                const pembayaran = button.dataset.pembayaran;
                const tanggal = button.dataset.tanggal;

                modalNama.textContent = nama;
                modalHp.textContent = hp;
                modalAlamat.textContent = alamat;
                modalBarang.textContent = barang;
                modalMetode.textContent = metode;
                modalPembayaran.textContent = pembayaran;
                modalTanggal.textContent = tanggal;

                mapLink.href =
                    `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(alamat)}`;
                whatsappLink.href =
                    `https://wa.me/${hp.replace('+', '')}?text=Halo%20${encodeURIComponent(nama)},%20pesanan%20anda%20telah%20diantar.%20Terima%20kasih!`;

                modal.style.display = 'flex';
            });
        });

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function(e) {
            if (e.target === modal) closeModal();
        }
    </script>

</body>

</html>
