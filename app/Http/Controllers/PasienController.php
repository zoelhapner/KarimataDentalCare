<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $pasiens = Pasien::all(); // Mengambil semua data pasien
    //     return view('pasiens.index', compact('pasiens'));
    // }
    public function index()
{
    if(request()->ajax()) {

        $data = Pasien::query();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($pasien) {

                return '
                    <div class="flex justify-center gap-2">

                        <a href="'.route('pasiens.edit', $pasien->id_pasien).'"
                            class="px-3 py-2 text-xs font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                            Edit
                        </a>

                    </div>
                ';
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    return view('pasiens.index');
}

// public function index()
// {
//     $data = Pasien::query();

//     return DataTables::of($data)

//         ->addColumn('aksi', function ($pasien) {

//             return '
//                 <a href="'.route('pasiens.edit', $pasien->id_pasien).'"
//                     class="px-3 py-2 text-xs text-white bg-yellow-500 rounded-lg">
//                     Edit
//                 </a>
//             ';
//         })

//         ->rawColumns(['aksi'])
//         ->make(true);
// }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('pasiens.create', compact('provinces')); // Menampilkan form tambah pasien
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'required|string|max:500',
            'profesi' => 'nullable|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik',
            'nohp' => 'required|numeric|digits_between:10,15',
            'alergi' => 'nullable|string|max:500',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'sub_district_id' => 'nullable|exists:sub_districts,id',
            'postal_code_id' => 'nullable|exists:postal_codes,id',
        ]);

        Pasien::create($validatedData); // Menyimpan data pasien baru

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        return view('pasiens.show', compact('pasien')); // Menampilkan detail pasien
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        return view('pasiens.edit', compact('pasien')); // Menampilkan form edit pasien
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validatedData = $request->validate([
            'id_pasien' => 'required|unique:pasiens,id_pasien,' . $pasien->id_pasien . ',id_pasien', // Memperbolehkan ID yang sama
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat_pasien' => 'required|string|max:500',
            'profesi' => 'nullable|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:pasiens,nik,' . $pasien->id_pasien . ',id_pasien', // Memperbolehkan NIK yang sama
            'nohp' => 'required|numeric|digits_between:10,15',
            'alergi' => 'nullable|string|max:500',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'sub_district_id' => 'nullable|exists:sub_districts,id',
            'postal_code_id' => 'nullable|exists:postal_codes,id',
        ]);

        $pasien->update($validatedData); // Memperbarui data pasien

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete(); // Menghapus data pasien

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    /**
     * Bulk delete multiple records.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            Pasien::whereIn('id', explode(',', $ids))->delete(); // Menghapus beberapa pasien sekaligus
            return redirect()->route('pasiens.index')->with('success', 'Data pasien yang dipilih berhasil dihapus.');
        }

        return redirect()->route('pasiens.index')->with('error', 'Tidak ada data pasien yang dipilih untuk dihapus.');
    }
}
