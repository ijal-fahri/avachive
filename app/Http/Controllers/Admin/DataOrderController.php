<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuatOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cabangId = session('cabang_aktif_id');

        // Mulai query
        $query = BuatOrder::with('pelanggan');

        // Terapkan filter berdasarkan role
        if ($user->usertype !== 'owner') {
            $query->where('cabang_id', $user->cabang_id);
        } elseif ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }
        
        $orders = $query->orderBy('created_at', 'desc')
                        ->get()
                        ->groupBy(function ($order) {
                            return Carbon::parse($order->created_at)->format('Y-m-d');
                        });

        // Struktur data yang akan dikirim ke view
        $orderData = [];
        $availableYears = [];

        foreach ($orders as $date => $ordersOnDate) {
            $dailyTotal = 0;
            $dailyOrders = [];

            $year = Carbon::parse($date)->format('Y');
            if (!in_array($year, $availableYears)) {
                $availableYears[] = $year;
            }

            foreach ($ordersOnDate as $order) {
                $dailyOrders[] = [
                    'nama' => $order->pelanggan->nama ?? 'Pelanggan Dihapus',
                    'layanan' => $order->layanan,
                    'total_harga' => $order->total_harga,
                ];
                $dailyTotal += $order->total_harga;
            }

            $orderData[$date] = [
                'orders' => $dailyOrders,
                'total_pemasukan' => $dailyTotal
            ];
        }

        rsort($availableYears);

        return view('order', [
            'order_groups' => $orderData,
            'years' => $availableYears
        ]);
    }

    public function updateStatus(Request $request, BuatOrder $order)
    {
        // Keamanan: Pastikan user hanya bisa mengubah status order di cabangnya
        if (Auth::user()->usertype !== 'owner' && $order->cabang_id != Auth::user()->cabang_id) {
             abort(403);
        }
        // Jika owner, pastikan ordernya dari cabang yang sedang aktif di session
        if (Auth::user()->usertype === 'owner' && $order->cabang_id != session('cabang_aktif_id')){
             abort(403);
        }

        $request->validate(['status' => 'required|string']);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status berhasil diperbarui!']);
    }
}