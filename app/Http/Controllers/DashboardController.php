<?php

namespace App\Http\Controllers;

use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // Mengambil total pemasukkan berdasarkan id pengguna
        $totalPemasukkan = Pemasukkan::where('user_id', $userId)
                                ->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('user_id', $userId)
                                ->sum('jumlah');
        $totalKeseluruhan = $totalPemasukkan + $totalPengeluaran;

        return view('dashboard.index', compact('totalPemasukkan', 'totalPengeluaran', 'totalKeseluruhan'));
    }
}
