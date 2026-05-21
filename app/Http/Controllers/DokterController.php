<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\PostalCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Kasir;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Auth\Events\Registered;

class DokterController extends Controller
{

    // public function index()
    // {
    //     $dokters = Dokter::with('tindakans')->paginate(10);

    //     // Tambahkan penghasilan untuk setiap dokter
    //     foreach ($dokters as $dokter) {
    //         $dokter->penghasilan = $dokter->tindakans->sum('biaya');
    //     }

    //     return view('dokters.index', compact('dokters'));
    // }

    public function index()
    {
        if (request()->ajax()) {

            $data = Dokter::with('tindakans.kasus');

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('checkbox', function ($dokter) {

                    return '
                        <div class="flex items-center">
                            <input type="checkbox"
                                value="'.$dokter->id_dokter.'"
                                class="row-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                        </div>
                    ';
                })

                ->addColumn('penghasilan', function ($dokter) {

                    $total = 0;

                    foreach ($dokter->tindakans as $tindakan) {
                        $total += $tindakan->kasus->sum('biaya');
                    }

                    return 'Rp ' . number_format($total, 0, ',', '.');
                })
                ->editColumn('nama_dokter', function ($dokter) {
                    $url = route('dokters.show', $dokter->id_dokter);
                    $name = Str::title($dokter->nama_dokter ?? '-');
                    return '<a href="'.$url.'">'.e($name).'</a>';
                })
                ->addColumn('tanggal_lahir', fn($row) => $row->tanggal_lahir ? Carbon::parse($row->tanggal_lahir)->format('d/m/Y') : '-')
                ->addColumn('jadwal_praktik', function ($dokter) {

                    if (!$dokter->jadwalpraktikbaru) {
                        return '-';
                    }

                    $days = [
                        'senin' => 'Sen',
                        'selasa' => 'Sel',
                        'rabu' => 'Rab',
                        'kamis' => 'Kam',
                        'jumat' => 'Jum',
                        'sabtu' => 'Sab',
                        'minggu' => 'Min',
                    ];

                    $html = '<div class="space-y-1 min-w-[170px]">';

                    foreach ($days as $key => $label) {

                        $jadwal = $dokter->jadwalpraktikbaru[$key] ?? null;

                        // hanya tampilkan yang aktif
                        if (!$jadwal || !($jadwal['aktif'] ?? false)) {
                            continue;
                        }

                        $html .= '
                            <div class="flex items-center justify-between text-xs">

                                <span class="font-medium text-gray-700">
                                    '.$label.'
                                </span>

                                <span class="text-green-600 font-semibold">
                                    '.$jadwal['buka'].' - '.$jadwal['tutup'].'
                                </span>

                            </div>
                        ';
                    }

                    $html .= '</div>';

                    return $html;
                })
                ->addColumn('aksi', function ($dokter) {
                    $buttons = '';

                    $buttons .= '
                        <a href="' . route('dokters.edit', $dokter->id_dokter) . '"  
                            class="inline-flex items-center justify-center
                                w-10 h-10
                                rounded-xl
                                bg-amber-500 hover:bg-amber-600
                                text-white
                                transition-all duration-200 shadow-sm"
                            title="Edit">

                            <i class="ti ti-pencil text-[20px] leading-none"></i>

                        </a>
                    ';
                    return $buttons;
                })

                ->rawColumns(['checkbox', 'nama_dokter', 'aksi', 'jadwal_praktik'])
                ->make(true);
        }

        return view('dokters.index');
    }


    public function create()
    {
        $provinces = Province::all();
        return view('dokters.create', compact('provinces'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validator = $this->validateDokter($request);

        if ($validator->fails()) {
            return redirect()->route('dokters.create')
                ->withErrors($validator)
                ->withInput();
        }

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);


        // // Menyimpan data dokter
        // Dokter::create($request->only([
        //     'user_id', 'nama_dokter', 'role', 'nip', 'alamat',
        //     'tanggal_lahir', 'nik', 'nohp', 'jadwalpraktik', 'penghasilan'
        // ]));

        $user = User::create([
            'name' => $request->nama_dokter,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        // Menyimpan data dokter dengan menambahkan user_id dari user yang baru dibuat
        Dokter::create([
            'user_id' => $user->id, // Ambil ID user yang baru dibuat
            'nama_dokter' => $request->nama_dokter,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'nohp' => $request->nohp,
            'jadwalpraktikbaru' => collect($request->jadwal)
                ->map(function ($item) {

                    if (!isset($item['aktif'])) {
                        return [
                            'aktif' => false
                        ];
                    }

                    return [
                        'aktif' => true,
                        'buka'  => $item['buka'] ?? null,
                        'tutup' => $item['tutup'] ?? null,
                    ];
                })
                ->toArray(),
            'province_id'   => $request->province_id,
            'city_id'       => $request->city_id,
            'district_id'   => $request->district_id,
            'sub_district_id' => $request->sub_district_id,
            'postal_code_id'  => $request->postal_code_id, 
        ]);

        return redirect()->route('dokters.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show(Request $request, Dokter $dokter)
    {
        $startDate = $request->start_date
            ? Carbon\Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth();

        $endDate = $request->end_date
            ? Carbon\Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfDay();

        // Tindakan dokter
        $tindakans = $dokter->tindakans()
            ->with('kasir')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // Total transaksi dokter
        $totalBiaya = Kasir::whereHas('tindakan', function ($query) use ($dokter) {

                $query->where('dokter_id', $dokter->id_dokter);

            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_biaya');

        // Penghasilan dokter 40%
        $penghasilanDokter = $totalBiaya * 0.4;

        return view('dokters.show', [
            'dokter' => $dokter,
            'tindakans' => $tindakans,
            'penghasilanDokter' => $penghasilanDokter,
            'startDate' => $startDate->toDateString(),
            'endDate' => $endDate->toDateString(),
        ]);
    }

    public function edit(Dokter $dokter)
    {
        $provinces = Province::all();
        $cities = City::where('province_id', $dokter->province_id)->get();
        $districts = District::where('city_id', $dokter->city_id)->get();
        $subDistricts = SubDistrict::where('district_id', $dokter->district_id)->get();
        $postalCodes = PostalCode::where('sub_district_id', $dokter->sub_district_id)->get();
        return view('dokters.edit', compact('dokter', 'provinces', 'cities', 'districts', 'subDistricts', 'postalCodes'));
    }
    public function update(Request $request, Dokter $dokter)
    {
        // Validasi input
        $validator = $this->validateDokter($request, $dokter->id_dokter);

        if ($validator->fails()) {
            return redirect()->route('dokters.edit', $dokter)
                ->withErrors($validator)
                ->withInput();
        }

        $jadwalPraktik = collect($request->jadwal)
            ->map(function ($item) {

                if (!isset($item['aktif'])) {

                    return [
                        'aktif' => false
                    ];
                }

                return [
                    'aktif' => true,
                    'buka'  => $item['buka'] ?? null,
                    'tutup' => $item['tutup'] ?? null,
                ];
            })
            ->toArray();
        $dokter->update([

            'nama_dokter' => $request->nama_dokter,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'nohp' => $request->nohp,

            'jadwalpraktikbaru' => $jadwalPraktik,

            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'sub_district_id' => $request->sub_district_id,
            'postal_code_id' => $request->postal_code_id,
        ]);

        return redirect()->route('dokters.index')
            ->with('success', 'Data Dokter berhasil diperbarui.');
    }

    /**
     * Menghapus dokter dari database.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil dihapus.');
    }

    protected function validateDokter(Request $request, $dokterId = null)
    {
        $rules = [

            'nama_dokter' => 'required|string|max:255',

            'nip' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dokters', 'nip')
                    ->ignore($dokterId, 'id_dokter'),
            ],

            'alamat' => 'required|string|max:255',

            'tanggal_lahir' => 'required|date',

            'nik' => [
                'required',
                'digits:16',
                Rule::unique('dokters', 'nik')
                    ->ignore($dokterId, 'id_dokter'),
            ],

            'nohp' => 'required|digits_between:10,15',

            'jadwalpraktik' => 'nullable|string|max:255',
            'jadwal' => 'required|array',
            'jadwal.*.buka' => 'nullable|date_format:H:i',
            'jadwal.*.tutup' => 'nullable|date_format:H:i',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'sub_district_id' => 'nullable|exists:sub_districts,id',
            'postal_code_id' => 'nullable|exists:postal_codes,id',
        ];

        // CREATE ONLY
        if (!$dokterId) {

            $rules['email'] = 'required|string|max:255|unique:users,email';
            $rules['password'] = 'required|min:6';
        }

        return Validator::make($request->all(), $rules);
    }

    /**
     * Menghapus banyak dokter (bulk delete).
     */
    public function bulkDestroy(Request $request)
    {
        $dokterIds = $request->input('ids'); // Ambil ID dari request
        if (!$dokterIds || !is_array($dokterIds)) {
            return redirect()->route('dokters.index')->withErrors('Tidak ada dokter yang dipilih.');
        }

        Dokter::whereIn('id_dokter', $dokterIds)->delete(); // Hapus data dokter berdasarkan ID

        return redirect()->route('dokters.index')
            ->with('success', count($dokterIds) . ' dokter berhasil dihapus.');
    }
}
