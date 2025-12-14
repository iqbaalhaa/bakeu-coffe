<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\PesanPengunjung;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan angka
        $totalProduk       = Produk::count();
        $totalPesan        = PesanPengunjung::count();
        $totalProdukAktif  = Produk::where('status_aktif', true)->count();
        $totalFavorit      = Produk::where('ditandai_favorit', true)->count();

        // Chart: penambahan produk per bulan (6 bulan terakhir)
        $produkPerBulan = Produk::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $produkChart = [
            'labels' => $produkPerBulan->map(function ($row) {
                return Carbon::createFromFormat('Y-m', $row->bulan)->translatedFormat('M Y');
            }),
            'data'   => $produkPerBulan->pluck('total'),
        ];

        // Chart: ringkasan pesan (hari ini, 7 hari, 30 hari)
        $today      = Carbon::today();
        $totalPesanHariIni = PesanPengunjung::whereDate('created_at', $today)->count();
        $totalPesan7Hari   = PesanPengunjung::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $totalPesan30Hari  = PesanPengunjung::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesan',
            'totalProdukAktif',
            'totalFavorit',
            'produkChart',
            'totalPesanHariIni',
            'totalPesan7Hari',
            'totalPesan30Hari'
        ));
    }
}
