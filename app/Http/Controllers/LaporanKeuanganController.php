<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\Kasir;

class LaporanKeuanganController extends Controller
{
    // public function laporanKeuangan(Request $request)
    // {
    //     // Default: 30 hari terakhir
    //     $startDate = $request->start_date ?: now()->subDays(30)->toDateString();
    //     $endDate = $request->end_date ?: now()->toDateString();

    //     // Filter transaksi berdasarkan tanggal
    //     // $transaksi = Kasir::whereBetween('created_at', [$startDate, $endDate])->get();
    //     $transaksi = Kasir::with([
    //         'tindakan.dokter'
    //     ])
    //     ->whereHas('tindakan', function ($q) use ($startDate, $endDate) {

    //         $q->whereBetween('tanggal_visit', [$startDate, $endDate]);
    //     })
    //     ->latest()
    //     ->paginate(10)
    //     ->withQueryString();

    //     // Total pemasukan
    //     $totalPemasukan = $transaksi->sum('total_biaya');

    //     // Pembagian hasil
    //     $dokterShare = $totalPemasukan * 0.4; // Dokter 40%
    //     $klinikShare = $totalPemasukan * 0.6; // Klinik 60%

    //     // Menghitung estimasi pendapatan untuk setiap dokter
    //     // Mendapatkan semua dokter
    //     $dokters = Dokter::all();

    //     // Menghitung estimasi pendapatan untuk setiap dokter
    //     foreach ($dokters as $dokter) {
    //         // Memfilter transaksi berdasarkan hubungan dokter dengan tindakan
    //         $transaksiDokter = $transaksi->filter(function ($kasir) use ($dokter) {
    //             return $kasir->tindakan->dokter_id == $dokter->id_dokter;
    //         });

    //         // Menghitung total pendapatan untuk dokter (misal: 40% dari total biaya)
    //         $dokter->biaya = $transaksiDokter->sum('total_biaya') * 0.4;
    //     }

    //     return view('laporan_keuangan', compact('transaksi', 'totalPemasukan', 'dokterShare', 'klinikShare', 'startDate', 'endDate', 'dokters'));
    // }
    public function laporanKeuangan(Request $request)
{
    $startDate = $request->start_date ?: now()->subDays(30)->toDateString();
    $endDate = $request->end_date ?: now()->toDateString();

    $query = Kasir::with([
        'tindakan.dokter'
    ])
    ->whereHas('tindakan', function ($q) use ($startDate, $endDate) {

        $q->whereBetween('tanggal_visit', [$startDate, $endDate]);

    });

    // PAGINATION
    $transaksi = (clone $query)
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // TOTAL SEMUA DATA
    $totalPemasukan = (clone $query)->sum('total_biaya');

    $dokterShare = $totalPemasukan * 0.4;
    $klinikShare = $totalPemasukan * 0.6;

    $dokters = Dokter::all();

    foreach ($dokters as $dokter) {

        $dokterTotal = Kasir::whereHas('tindakan', function ($q) use ($dokter, $startDate, $endDate) {

            $q->where('dokter_id', $dokter->id_dokter)
              ->whereBetween('tanggal_visit', [$startDate, $endDate]);

        })->sum('total_biaya');

        $dokter->biaya = $dokterTotal * 0.4;
    }

    return view('laporan_keuangan', compact(
        'transaksi',
        'totalPemasukan',
        'dokterShare',
        'klinikShare',
        'startDate',
        'endDate',
        'dokters'
    ));
}
}
