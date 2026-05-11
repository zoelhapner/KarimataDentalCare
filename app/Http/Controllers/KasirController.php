<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class KasirController extends Controller
{
    // public function index()
    // {
    //     $transaksi = Kasir::with(['tindakan.kasus', 'tindakan.dokter', 'tindakan.pasien'])->get();
    //     return view('kasir.index', compact('transaksi'));
    // }
    public function index()
    {
        if (request()->ajax()) {

            $data = Kasir::with([ 
                'tindakan.dokter',
                'tindakan.pasien'
            ])->orderBy('created_at', 'desc');

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', fn($row) => $row->tindakan?->tanggal_visit ? Carbon::parse($row->tindakan?->tanggal_visit)->format('d/m/Y') : '-')

            ->addColumn('dokter', function ($row) {
                return $row->tindakan?->dokter?->nama_dokter ?? 'N/A';
            })

            ->addColumn('pasien', function ($row) {
                return $row->tindakan?->pasien?->nama_pasien ?? 'N/A';
            })

                ->editColumn('total_biaya', function ($row) {
                    return number_format($row->total_biaya, 0, ',', '.');
                })

                ->editColumn('dibayar', function ($row) {
                    return number_format($row->dibayar, 0, ',', '.');
                })

                ->editColumn('kembalian', function ($row) {
                    return number_format($row->kembalian, 0, ',', '.');
                })

                ->addColumn('aksi', function ($row) {

                    return '
                        <div class="flex gap-2">

                            <a href="'.route('kasir.show', $row->id).'"
                                class="px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                Detail
                            </a>

                            <a href="'.route('kasir.edit', $row->id).'"
                                class="px-3 py-2 text-xs font-medium text-white bg-green-500 rounded-lg hover:bg-green-600">
                                Bayar
                            </a>

                            <a href="'.route('kasir.print', $row->id).'"
                                target="_blank"
                                class="px-3 py-2 text-xs font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                Print
                            </a>

                        </div>
                    ';
                })

                ->rawColumns(['aksi'])

                ->make(true);
        }

        return view('kasir.index');
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
