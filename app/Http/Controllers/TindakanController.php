<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Kasus;
use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TindakanController extends Controller
{
    // Menampilkan daftar tindakan
    // public function index(Request $request)
    // {
    //     // Ambil query pencarian pasien
    //     $query = $request->get('pasien_query');

    //     // Query untuk mencari berdasarkan nama pasien
    //     $tindakans = Tindakan::with(['dokter', 'pasien', 'kasus', 'kasir'])
    //         ->when($query, function ($queryBuilder) use ($query) {
    //             return $queryBuilder->whereHas('pasien', function ($pasienQuery) use ($query) {
    //                 $pasienQuery->where('nama_pasien', 'like', '%' . $query . '%');
    //             });
    //         })
    //         ->get();

    //     // Kirim data ke view
    //     return view('tindakan.index', compact('tindakans'));
    // }

public function index(Request $request)
{
    if ($request->ajax()) {

        $data = Tindakan::with([
            'dokter',
            'pasien',
            'kasus',
            'kasir'
        ])->orderBy('created_at', 'desc');

        if ($request->filled('pasien_query')) {

            $search = $request->pasien_query;

            $data->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama_pasien', 'ilike', "%{$search}%");
            });
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_pasien', function ($row) {
                return $row->pasien->nama_pasien ?? '-';
            })

            ->addColumn('nama_dokter', function ($row) {
                return $row->dokter->nama_dokter ?? '-';
            })
            ->addColumn('tanggal_visit', fn($row) => $row->tanggal_visit ? Carbon::parse($row->tanggal_visit)->format('d/m/Y') : '-')
            ->addColumn('jam', function ($row) {
                return $row->jam ?? '-';
            })
             ->addColumn('tindakan', function ($row) {
                return $row->tindakan ?? '-';
            })

            ->addColumn('aksi', function ($row) {

                return '
                    <div class="flex items-center gap-2">

                        <a href="'.route('tindakan.edit', $row->id).'"
                            class="px-3 py-2 text-xs font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                            Edit
                        </a>

                        <a href="'.route('tindakan.show', $row->id).'"
                            class="px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            Lihat
                        </a>

                    </div>
                ';
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    return view('tindakan.index');
}

    // Menampilkan form untuk menambah tindakan
    public function create()
    {
        $dokters = Dokter::all(); // Ambil semua dokter
        $pasiens = Pasien::all(); // Ambil semua pasien
        return view('tindakan.create', compact('dokters', 'pasiens'));
    }

    // Menyimpan data tindakan dan kasus serta membuat entri di kasir
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'dokter_id' => 'required|exists:dokters,id_dokter',
            'pasien_id' => 'required|exists:pasiens,id_pasien',
            'tanggal_visit' => 'required|date',
            'jam' => 'required',
            'tindakan' => 'nullable|string',
            'pemakaian_obat' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'kasus' => 'required|array',
            'kasus.*' => 'required|string',
            'diagnosa' => 'required|array',
            'diagnosa.*' => 'nullable|string',
            'tindakan_khusus' => 'required|array',
            'tindakan_khusus.*' => 'required|string',
            'biaya' => 'required|array',
            'biaya.*' => 'required|numeric|min:0',
        ]);

        // Debugging
        // dd($validated); // Pastikan ini menunjukkan data yang benar

        // Menyimpan Tindakan
        $tindakan = Tindakan::create([
            'dokter_id' => $validated['dokter_id'],
            'pasien_id' => $validated['pasien_id'],
            'tanggal_visit' => $validated['tanggal_visit'],
            'jam' => $validated['jam'],
            'tindakan' => $validated['tindakan'],
            'pemakaian_obat' => $validated['pemakaian_obat'],
            'tindak_lanjut' => $validated['tindak_lanjut'],
        ]);

        // Menyimpan Kasus
        $total_biaya = 0;
        foreach ($validated['kasus'] as $index => $kasus) {
            Kasus::create([
                'tindakan_id' => $tindakan->id,
                'kasus' => $kasus,
                'diagnosa' => $validated['diagnosa'][$index],
                'tindakan_khusus' => $validated['tindakan_khusus'][$index],
                'biaya' => $validated['biaya'][$index],
            ]);

            $total_biaya += $validated['biaya'][$index]; // Hitung total biaya
        }

        // Menyimpan data ke Kasir
        Kasir::create([
            'tindakan_id' => $tindakan->id,
            'total_biaya' => $total_biaya,
            'dibayar' => 0, // Default, akan diperbarui nanti
            'kembalian' => 0, // Default
            'metode_pembayaran' => '-',
        ]);

        return redirect()->route('tindakan.index')->with('success', 'Tindakan, kasus, dan transaksi kasir berhasil ditambahkan!');
    }

    // Menampilkan detail tindakan dan kasus terkait
    public function show($id)
    {
        $tindakan = Tindakan::with('kasus', 'kasir')->findOrFail($id); // Sertakan transaksi kasir
        return view('tindakan.show', compact('tindakan'));
    }

    // Menampilkan form untuk mengedit tindakan
    public function edit($id)
    {
        // Cek apakah pengguna adalah Manager
        if (!in_array(session('user_role'), ['manager', 'dokter'])) {
            return redirect()->route('tindakan.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit tindakan.');
        }

        $tindakan = Tindakan::with('kasus')->findOrFail($id);
        $dokters = Dokter::all(); 
        $pasiens = Pasien::all();

        return view('tindakan.edit', compact('tindakan', 'dokters', 'pasiens'));
    }

    // Mengupdate data tindakan, kasus, dan kasir
    public function update(Request $request, $id)
    {
        if (!in_array(session('user_role'), ['manager', 'dokter'])) {
            return redirect()->route('tindakan.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit tindakan.');
        }

        $validated = $request->validate([
            'dokter_id' => 'required|exists:dokters,id_dokter',
            'pasien_id' => 'required|exists:pasiens,id_pasien',
            'tanggal_visit' => 'required|date',
            'jam' => 'required',
            'tindakan' => 'nullable|string',
            'pemakaian_obat' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'kasus' => 'required|array',
            'kasus.*' => 'required|string',
            'diagnosa' => 'required|array',
            'diagnosa.*' => 'nullable|string',
            'tindakan_khusus' => 'required|array',
            'tindakan_khusus.*' => 'required|string',
            'biaya' => 'required|array',
            'biaya.*' => 'required|numeric|min:0',
        ]);

        $tindakan = Tindakan::findOrFail($id);
        $tindakan->update([
            'dokter_id' => $validated['dokter_id'],
            'pasien_id' => $validated['pasien_id'],
            'tanggal_visit' => $validated['tanggal_visit'],
            'jam' => $validated['jam'],
            'tindakan' => $validated['tindakan'],
            'pemakaian_obat' => $validated['pemakaian_obat'],
            'tindak_lanjut' => $validated['tindak_lanjut'],
        ]);

        // Hapus kasus lama dan tambahkan yang baru
        $tindakan->kasus()->delete();
        $total_biaya = 0;
        foreach ($validated['kasus'] as $index => $kasus) {
            Kasus::create([
                'tindakan_id' => $tindakan->id,
                'kasus' => $kasus,
                'diagnosa' => $validated['diagnosa'][$index],
                'tindakan_khusus' => $validated['tindakan_khusus'][$index],
                'biaya' => $validated['biaya'][$index],
            ]);

            $total_biaya += $validated['biaya'][$index];
        }

        // Perbarui transaksi kasir
        $tindakan->kasir->update([
            'total_biaya' => $total_biaya,
        ]);

        return redirect()->route('tindakan.index')->with('success', 'Tindakan, kasus, dan transaksi kasir berhasil diperbarui!');
    }

    // Menghapus tindakan, kasus, dan transaksi kasir
    public function destroy($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->kasus()->delete(); // Hapus semua kasus terkait
        $tindakan->kasir()->delete(); // Hapus transaksi kasir
        $tindakan->delete(); // Hapus tindakan

        return redirect()->route('tindakan.index')->with('success', 'Tindakan, kasus, dan transaksi kasir berhasil dihapus!');
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];

        if ($request->filled('q')) {
            $data = Pasien::select("nama_pasien", "id_pasien")
                ->where('nama_pasien', 'ILIKE', '%' . $request->get('q') . '%')
                ->take(10)
                ->get();
        }

        return response()->json($data);
    }

    // Tambahkan metode filterPasien di dalam TindakanController
    public function filterPasien(Request $request)
    {
        // Mengambil data pencarian pasien jika ada
        $query = $request->get('pasien_query');

        // Query untuk mencari berdasarkan nama pasien
        $tindakans = Tindakan::with(['dokter', 'pasien', 'kasus', 'kasir'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('pasien', function ($pasienQuery) use ($query) {
                    $pasienQuery->where('nama_pasien', 'ilike', '%' . $query . '%');
                });
            })
            ->get();

        return view('tindakan.index', compact('tindakans'));
    }
}
