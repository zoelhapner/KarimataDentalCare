<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::all();
        return view('obats.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat'     => 'required|string|max:255',
            'merk'          => 'required|string|max:255',
            'ukuran'        => 'required|string|max:255',
            'harga_beli'    => 'required|numeric|min:0',
            'tanggal_beli'  => 'required|date',
            'supplier'      => 'required|string|max:255',
        ]);

        Obat::create($validated);

        return redirect()
            ->route('obats.index')
            ->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('obats.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'tanggal_beli' => 'required|date',
            'supplier' => 'required|string|max:255',
        ]);

        $obat->update($request->all());
        return redirect()->route('obats.index')->with('success', 'Obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obats.index')->with('success', 'Obat berhasil dihapus.');
    }
}
