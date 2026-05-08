<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasir;

use Illuminate\Auth\Events\Registered;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar dokter.
     */
    public function index()
    {
        $dokters = Dokter::with('tindakans')->paginate(10);

        // Tambahkan penghasilan untuk setiap dokter
        foreach ($dokters as $dokter) {
            $dokter->penghasilan = $dokter->tindakans->sum('biaya');
        }

        return view('dokters.index', compact('dokters'));
    }


    /**
     * Menampilkan form untuk menambahkan dokter baru.
     */
    public function create()
    {
        return view('dokters.create');
    }

    /**
     * Menyimpan dokter baru ke database.
     */
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
            'jadwalpraktik' => $request->jadwalpraktik,
        ]);

        return redirect()->route('dokters.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail dokter.
     */
    public function show(Request $request, Dokter $dokter)
    {

        if (!$dokter) {
            return redirect()->route('dokters.index')->withErrors('Dokter tidak ditemukan.');
        }

        $startDate = $request->input('start_date', now()->firstOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $tindakans = $dokter->tindakans()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with("kasir")
            ->get();

        // Filter transaksi berdasarkan dokter dan rentang tanggal
        $transaksi = Kasir::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas("tindakan", function ($query) use ($dokter) {
                $query->where("dokter_id", $dokter->id_dokter);
            })
            ->with("tindakan")
            ->get();

        // dd($transaksi);

        // Hitung biaya bagian dokter (40%)
        $biaya = $transaksi->sum('total_biaya');
        $biaya = $biaya * 0.4; // Bagian dokter (40%)

        $penghasilanDokter = $biaya;

        return view('dokters.show', compact('dokter', 'tindakans', 'penghasilanDokter', 'startDate', 'endDate'))
            ->with('biaya', $penghasilanDokter);
    }

    /**
     * Memperbarui data dokter di database.
     */
    public function update(Request $request, Dokter $dokter)
    {
        // Validasi input
        $validator = $this->validateDokter($request, $dokter->id);

        if ($validator->fails()) {
            return redirect()->route('dokters.edit', $dokter)
                ->withErrors($validator)
                ->withInput();
        }

        // Memperbarui data dokter
        $dokter->update($request->only([
            'user_id',
            'nama_dokter',
            'role',
            'nip',
            'alamat',
            'tanggal_lahir',
            'nik',
            'nohp',
            'jadwalpraktik',
            'penghasilan'
        ]));

        return redirect()->route('dokters.index')
            ->with('success', 'Dokter berhasil diperbarui.');
    }

    /**
     * Menghapus dokter dari database.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokters.index')->with('success', 'Dokter berhasil dihapus.');
    }

    /**
     * Validasi data dokter untuk store dan update.
     */
    protected function validateDokter(Request $request, $dokterId = null)
    {
        return Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required',
            'nama_dokter' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:dokters,nip,' . $dokterId,
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|digits:16|unique:dokters,nik,' . $dokterId,
            'nohp' => 'required|digits_between:10,15',
            'jadwalpraktik' => 'required|string|max:255',
        ]);
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
