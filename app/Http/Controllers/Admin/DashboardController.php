<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuatOrder;
use App\Models\TambahPelanggan;
use App\Models\Layanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();

        // 1. STATISTIK KARTU RINGKASAN (Tidak ada perubahan)
        $pendapatan_tahun_ini = BuatOrder::whereYear('created_at', $now->year)->sum('total_harga');
        $pendapatan_bulan_ini = BuatOrder::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->sum('total_harga');
        $total_order_tahun_ini = BuatOrder::whereYear('created_at', $now->year)->count();
        $total_order_bulan_ini = BuatOrder::whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->count();
        $jumlah_pelanggan = TambahPelanggan::count();
        $jumlah_layanan = Layanan::count();

        // 2. DATA UNTUK GRAFIK (BAGIAN INI DI-UPGRADE UNTUK CHART.JS)
        $statistik_bulanan = BuatOrder::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereYear('created_at', $now->year)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->pluck('jumlah', 'bulan') // Kita ambil data sebagai pasangan [bulan => jumlah]
            ->all();

        // Siapkan array untuk label (nama bulan) dan data (jumlah order)
        $chart_labels = [];
        $chart_data = [];
        $nama_bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

        for ($i = 1; $i <= 12; $i++) {
            $chart_labels[] = $nama_bulan[$i - 1];
            // Jika ada data untuk bulan ini, gunakan. Jika tidak, isi dengan 0.
            $chart_data[] = $statistik_bulanan[$i] ?? 0;
        }


        // 3. DATA UNTUK TABEL PESANAN HARI INI (Tidak ada perubahan)
        $pesanan_hari_ini = BuatOrder::with('pelanggan')
                                     ->whereDate('created_at', $now->today())
                                     ->latest()
                                     ->get();

        // 4. KIRIM SEMUA DATA KE VIEW
        return view('admin.dashboard', [
            'pendapatan_tahun_ini' => $pendapatan_tahun_ini,
            'pendapatan_bulan_ini' => $pendapatan_bulan_ini,
            'total_order_tahun_ini' => $total_order_tahun_ini,
            'total_order_bulan_ini' => $total_order_bulan_ini,
            'jumlah_pelanggan' => $jumlah_pelanggan,
            'jumlah_layanan' => $jumlah_layanan,
            'chart_labels' => $chart_labels, // DIUBAH: Kirim label untuk chart
            'chart_data' => $chart_data,     // DIUBAH: Kirim data untuk chart
            'pesanan_hari_ini' => $pesanan_hari_ini,
        ]);
    }
}