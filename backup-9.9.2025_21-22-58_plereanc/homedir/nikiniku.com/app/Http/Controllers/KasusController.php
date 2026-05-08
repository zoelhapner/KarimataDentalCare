<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    /**
     * Tampilkan daftar kasus.
     */
    public function index()
    {
        $kasus = Kasus::with('tindakan')->get(); // Mengambil semua data kasus beserta tindakan terkait
        return view('kasus.index', compact('kasus'));
    }

    /**
     * Tampilkan form untuk membuat kasus baru.
     */
    public function create()
    {
        $tindakans = Tindakan::all(); // Ambil semua tindakan untuk ditampilkan di form
        return view('kasus.create', compact('tindakans'));
    }

    /**
     * Simpan kasus baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tindakan_id' => 'required|exists:tindakans,id', // Validasi tindakan harus ada
            'kasus' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        Kasus::create($validated);

        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kasus tertentu.
     */
    public function show(Kasus $kasus)
    {
        return view('kasus.show', compact('kasus'));
    }

    /**
     * Tampilkan form untuk mengedit kasus.
     */
    public function edit(Kasus $kasus)
    {
        $tindakans = Tindakan::all(); // Ambil semua tindakan untuk dropdown
        return view('kasus.edit', compact('kasus', 'tindakans'));
    }

    /**
     * Update data kasus di database.
     */
    public function update(Request $request, Kasus $kasus)
    {
        $validated = $request->validate([
            'tindakan_id' => 'required|exists:tindakans,id', // Validasi tindakan harus ada
            'kasus' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        $kasus->update($validated);

        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil diperbarui!');
    }

    /**
     * Hapus kasus dari database.
     */
    public function destroy(Kasus $kasus)
    {
        $kasus->delete();

        return redirect()->route('kasus.index')->with('success', 'Kasus berhasil dihapus!');
    }
}
