<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $transaksi = Kasir::with(['tindakan.kasus', 'tindakan.dokter', 'tindakan.pasien'])->get(); // Ambil semua transaksi dengan tindakan dan kasus
        return view('kasir.index', compact('transaksi'));
    }

    public function show($id)
    {
        $kasir = Kasir::with('tindakan.kasus')->findOrFail($id); // Detail transaksi
        return view('kasir.show', compact('kasir'));
    }

    public function edit($id)
    {
        $kasir = Kasir::findOrFail($id);
        return view('kasir.edit', compact('kasir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dibayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,qris,transfer,edc'
        ]);

        $kasir = Kasir::findOrFail($id);
        $kasir->dibayar = $request->dibayar;
        $kasir->kembalian = $request->dibayar - $kasir->total_biaya;
        $kasir->metode_pembayaran = $request->metode_pembayaran;
        $kasir->save();

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function printNota($id)
    {
        $kasir = Kasir::with(['tindakan.kasus', 'tindakan.dokter', 'tindakan.pasien'])->findOrFail($id);
        return view('kasir.nota', compact('kasir'));
    }
}
