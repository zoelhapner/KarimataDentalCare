<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kasir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan data login dokter/admin.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Ambil tanggal mulai dan akhir dari request, defaultnya periode bulan ini
        $startDate = Carbon::parse( $request->input('start_date', now()->firstOfMonth()->toDateString()) )->startOfDay(); 
        $endDate = Carbon::parse( $request->input('end_date', now()->toDateString()) )->endOfDay();

        // Query data untuk role dokter
        if (session('user_role') == 'dokter') {
            $dokter = Dokter::where('user_id', $userId)->first();

            // Filter transaksi berdasarkan dokter dan rentang tanggal
            $transaksi = Kasir::whereBetween('created_at', [$startDate, $endDate])
                ->whereHas("tindakan", function ($query) use ($dokter) {
                    $query->where("dokter_id", $dokter->id_dokter);
                })
                ->with("tindakan")
                ->get();

            // Hitung biaya bagian dokter (40%)
            $biaya = $transaksi->sum('total_biaya');
            $biaya = $biaya * 0.4; // Bagian dokter (40%)

            return view('dashboard', compact('dokter', 'biaya', 'transaksi', 'startDate', 'endDate'));
        }

        // Query data untuk admin atau manager
        if (session('user_role') == 'admin' || session('user_role') == 'manager') {
            // Ambil semua transaksi klinik dalam rentang tanggal
            $transaksiKlinik = Kasir::whereBetween('created_at', [$startDate, $endDate])->get();

            // Hitung total pendapatan klinik (tanpa dipotong bagi hasil dokter)
            $totalPendapatanKlinik = $transaksiKlinik->sum('total_biaya');

            // Menghitung estimasi pendapatan untuk setiap dokter
            // Mendapatkan semua dokter
            $dokters = Dokter::all();

            // Menghitung estimasi pendapatan untuk setiap dokter
            foreach ($dokters as $dokter) {
                // Memfilter transaksi berdasarkan hubungan dokter dengan tindakan
                $transaksiDokter = $transaksiKlinik->filter(function ($kasir) use ($dokter) {
                    return $kasir->tindakan->dokter_id == $dokter->id_dokter;
                });

                // Menghitung total pendapatan untuk dokter (misal: 40% dari total biaya)
                $dokter->biaya = $transaksiDokter->sum('total_biaya') * 0.4;
            }

            $chartLabels = []; // Label untuk grafik (misal: bulan)
            $chartData = [];   // Data untuk grafik (pendapatan klinik per bulan)

            // Kelompokkan transaksi berdasarkan bulan
            $monthlyData = $transaksiKlinik->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('F Y'); // Format Bulan Tahun
            });

            // Siapkan data untuk grafik
            foreach ($monthlyData as $month => $items) {
                // Hitung total pendapatan klinik untuk bulan tersebut
                $monthlyClinicEarnings = $items->sum('total_biaya'); // Pendapatan klinik tanpa bagi hasil dokter
                if (!in_array($month, $chartLabels)) {
                    $chartLabels[] = $month;
                }

                $chartData[] = $monthlyClinicEarnings;
            }

            return view('dashboard', compact('chartLabels', 'chartData', 'totalPendapatanKlinik', 'dokters', 'startDate', 'endDate'));
        }

        return abort(403); // Dilarang jika role tidak dikenali
    }
}
