<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuatOrder;
use Carbon\Carbon; // Pastikan Carbon di-import

class DataOrderController extends Controller
{
    public function index()
    {
        // Ambil semua order, di-group berdasarkan tanggal
        $orders = BuatOrder::with('pelanggan')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($order) {
                // Group berdasarkan format YYYY-MM-DD
                return Carbon::parse($order->created_at)->format('Y-m-d');
            });

        // Struktur data yang akan dikirim ke view
        $orderData = [];
        
        // 1. Array untuk menampung tahun, diinisialisasi sebagai array kosong
        $availableYears = [];

        foreach ($orders as $date => $ordersOnDate) {
            $dailyTotal = 0;
            $dailyOrders = [];

            // Mengambil tahun dari tanggal untuk filter dropdown
            $year = Carbon::parse($date)->format('Y');
            if (!in_array($year, $availableYears)) {
                $availableYears[] = $year;
            }

            foreach ($ordersOnDate as $order) {
                $dailyOrders[] = [
                    'nama' => $order->pelanggan->nama ?? 'Pelanggan Dihapus',
                    'total_harga' => $order->total_harga,
                ];
                $dailyTotal += $order->total_harga;
            }

            $orderData[$date] = [
                'orders' => $dailyOrders,
                'total_pemasukan' => $dailyTotal
            ];
        }

        // Mengurutkan tahun dari yang terbaru
        rsort($availableYears);

        // 2. Mengirim variabel 'years' ke view bersama dengan 'orders'
        return view('order', [
            'orders' => $orderData,
            'years' => $availableYears // <-- BARIS INI YANG MENGIRIM VARIABEL $years
        ]);
    }
}