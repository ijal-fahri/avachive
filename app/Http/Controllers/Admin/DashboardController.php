<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuatOrder;
use App\Models\TambahPelanggan;
use App\Models\Layanan;
use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data yang sudah difilter.
     */
    public function index()
    {
        $user = Auth::user();
        $semuaCabang = Cabang::all();
        $cabangId = null;

        // --- LOGIKA PEMILIHAN CABANG YANG DISEMPURNAKAN ---
        if ($user->usertype === 'owner') {
            // Jika OWNER, dia BEBAS memilih. Ambil dari session.
            // Jika session kosong (baru login), baru pilih cabang pertama sebagai default.
            $cabangId = session('cabang_aktif_id', $semuaCabang->first()->id ?? null);
            
            // Pastikan session selalu ter-update untuk owner
            if ($cabangId) {
                session(['cabang_aktif_id' => $cabangId]);
            }
        } else {
            // Jika BUKAN OWNER (Admin Cabang, Kasir, dll), datanya DIKUNCI
            // ke cabang_id milik user itu sendiri. Titik.
            $cabangId = $user->cabang_id;
        }
        // --- AKHIR LOGIKA ---

        // Inisialisasi query builder
        $orderQuery = BuatOrder::query();
        $layananQuery = Layanan::query();
        $pelangganQuery = TambahPelanggan::query();

        // Terapkan filter HANYA JIKA ada cabangId yang valid
        if ($cabangId) {
            $orderQuery->where('cabang_id', $cabangId);
            $layananQuery->where('cabang_id', $cabangId);
            $pelangganQuery->where('cabang_id', $cabangId);
        } else {
            // Jika tidak ada cabang sama sekali (misal database kosong), jangan tampilkan apa-apa
            $orderQuery->where('cabang_id', -1); // ID yang tidak mungkin ada
            $layananQuery->where('cabang_id', -1);
            $pelangganQuery->where('cabang_id', -1);
        }

        // --- KALKULASI DATA BERDASARKAN QUERY YANG SUDAH DIFILTER ---
        $pendapatan_tahun_ini = (clone $orderQuery)->whereYear('created_at', now()->year)->sum('total_harga');
        $pendapatan_bulan_ini = (clone $orderQuery)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('total_harga');
        $total_order_tahun_ini = (clone $orderQuery)->whereYear('created_at', now()->year)->count();
        $total_order_bulan_ini = (clone $orderQuery)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $order_selesai = (clone $orderQuery)->where('status', 'Selesai')->count();
        $jumlah_pelanggan = $pelangganQuery->count();
        $jumlah_layanan = $layananQuery->count();
        $pesanan_hari_ini = (clone $orderQuery)->with('pelanggan')->whereDate('created_at', now()->today())->latest()->get();

        // --- INFO CABANG ---
        $cabangTop = DB::table('buat_orders')->join('cabangs', 'buat_orders.cabang_id', '=', 'cabangs.id')
            ->select('cabangs.nama_cabang', DB::raw('SUM(buat_orders.total_harga) as total_pemasukan'))
            ->groupBy('cabangs.nama_cabang')->orderByDesc('total_pemasukan')->first();
        
        $layananCounts = [];
        if ($cabangId) {
            $ordersInBranch = BuatOrder::where('cabang_id', $cabangId)->pluck('layanan');
            foreach ($ordersInBranch as $layananJson) {
                $services = json_decode($layananJson, true) ?? [];
                foreach ($services as $service) {
                    $namaLayanan = $service['nama'] ?? 'N/A';
                    if (!isset($layananCounts[$namaLayanan])) $layananCounts[$namaLayanan] = 0;
                    $layananCounts[$namaLayanan] += ($service['kuantitas'] ?? 0);
                }
            }
        }
        arsort($layananCounts);
        $layananFavorit = key($layananCounts) ?: 'Belum ada';

        // --- DATA GRAFIK ---
        $statistik_bulanan = (clone $orderQuery)->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as jumlah'))
            ->whereYear('created_at', now()->year)->groupBy('bulan')->orderBy('bulan', 'asc')->pluck('jumlah', 'bulan')->all();
        
        $chart_labels = []; $chart_data = []; $nama_bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i = 1; $i <= 12; $i++) {
            $chart_labels[] = $nama_bulan[$i - 1];
            $chart_data[] = $statistik_bulanan[$i] ?? 0;
        }

        // --- KIRIM SEMUA DATA KE VIEW ---
        return view('admin.dashboard', [
            'pendapatan_tahun_ini' => $pendapatan_tahun_ini, 'pendapatan_bulan_ini' => $pendapatan_bulan_ini,
            'total_order_tahun_ini' => $total_order_tahun_ini, 'total_order_bulan_ini' => $total_order_bulan_ini,
            'jumlah_pelanggan' => $jumlah_pelanggan, 'jumlah_layanan' => $jumlah_layanan,
            'order_selesai' => $order_selesai, 'pesanan_hari_ini' => $pesanan_hari_ini,
            'chart_labels' => $chart_labels, 'chart_data' => $chart_data,
            'semuaCabang' => $semuaCabang, 'cabangTerpilihId' => $cabangId,
            'cabangTop' => $cabangTop, 'layananFavorit' => $layananFavorit,
        ]);
    }

    /**
     * Mengatur cabang aktif di session untuk owner.
     */
    public function setCabangAktif(Cabang $cabang)
    {
        if (Auth::user()->usertype !== 'owner') {
            abort(403, 'Anda tidak memiliki akses untuk mengganti cabang.');
        }
        session(['cabang_aktif_id' => $cabang->id]);
        return redirect()->route('dashboard');
    }
}