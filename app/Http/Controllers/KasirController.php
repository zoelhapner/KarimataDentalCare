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
            ])
            ->when(request('start_date') && request('end_date'), function ($query) {
                $query->whereHas('tindakan', function ($q) {
                    $q->whereBetween('tanggal_visit', [
                        request('start_date'),
                        request('end_date')
                    ]);
                });

            })
            ->orderBy('created_at', 'desc');

            return DataTables::of($data)
            ->filter(function ($query) {

                if ($search = request('search')['value']) {

                    $query->where(function ($q) use ($search) {

                        $q->where('metode_pembayaran', 'ilike', "%{$search}%")

                            ->orWhereHas('tindakan.pasien', function ($pasien) use ($search) {

                                $pasien->where('nama_pasien', 'ilike', "%{$search}%");

                            })

                            ->orWhereHas('tindakan.dokter', function ($dokter) use ($search) {

                                $dokter->where('nama_dokter', 'ilike', "%{$search}%");

                            });

                    });

                }

            })
            ->addIndexColumn()
            ->addColumn('tanggal', fn($row) => $row->tindakan?->tanggal_visit ? Carbon::parse($row->tindakan?->tanggal_visit)->format('d/m/Y') : '-')

            ->addColumn('nama_dokter', function ($row) {
                return $row->tindakan?->dokter?->nama_dokter ?? 'N/A';
            })

            ->addColumn('nama_pasien', function ($row) {
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

                // ->addColumn('aksi', function ($row) {

                //     return '
                //         <div class="flex gap-2">

                //             <a href="'.route('kasir.show', $row->id).'"
                //                 class="px-3 py-2 text-xs font-medium text-white bg-primary-700 rounded-lg hover:bg-blue-600">
                //                 Detail
                //             </a>
                //             $buttons .= '
                //                 <a href="' . route('tindakan.show', $row->id) . '"  
                //                     class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-primary-700 hover:bg-blue-700 text-white transition-all duration-200 shadow-sm"
                //                     title="Lihat">

                //                     <i class="ti ti-eye text-sm leading-none"></i>

                //                 </a>
                //             ';

                //             <a href="'.route('kasir.edit', $row->id).'"
                //                 class="px-3 py-2 text-xs font-medium text-white bg-green-500 rounded-lg hover:bg-green-600">
                //                 Bayar
                //             </a>


                //             <a href="'.route('kasir.print', $row->id).'"
                //                 target="_blank"
                //                 class="px-3 py-2 text-xs font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                //                 Print
                //             </a>

                //         </div>
                //     ';
                // })
                ->addColumn('aksi', function ($row) {

                    $buttons = '<div class="flex items-center justify-center gap-2">';

                    $buttons .= '
                        <a href="' . route('kasir.edit', $row->id) . '"  
                            class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-amber-500 hover:bg-amber-600 text-white transition-all duration-200 shadow-sm"
                            title="Edit">

                            <i class="ti ti-pencil text-sm leading-none"></i>

                        </a>
                    ';

                    $buttons .= '
                        <a href="' . route('kasir.show', $row->id) . '"  
                            class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-primary-700 hover:bg-blue-700 text-white transition-all duration-200 shadow-sm"
                            title="Lihat">

                            <i class="ti ti-eye text-sm leading-none"></i>

                        </a>
                    ';

                    $buttons .= '
                        <a href="' . route('kasir.print', $row->id) . '"  
                            class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-red-700 hover:bg-red-500 text-white transition-all duration-200 shadow-sm"
                            title="Print Nota">

                            <i class="ti ti-printer text-sm leading-none"></i>

                        </a>
                    ';

                    $buttons .= '</div>';

                    return $buttons;
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
