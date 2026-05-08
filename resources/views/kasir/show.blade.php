<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi Kasir') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold">Detail Transaksi</h3>
            <p><strong>Tanggal Visit:</strong> {{ $kasir->tindakan->tanggal_visit }}</p>
            <p><strong>Dokter:</strong> {{ $kasir->tindakan->dokter->nama_dokter ?? 'N/A' }}</p>
            <p><strong>Pasien:</strong> {{ $kasir->tindakan->pasien->nama_pasien ?? 'N/A' }}</p>
            <p><strong>Total Biaya:</strong> {{ number_format($kasir->total_biaya, 0, ',', '.') }}</p>
            <p><strong>Dibayar:</strong> {{ number_format($kasir->dibayar, 0, ',', '.') }}</p>
            <p><strong>Kembalian:</strong> {{ number_format($kasir->kembalian, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $kasir->metode_pembayaran }}</p>
            <a href="{{ route('kasir.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">Kembali</a>
        </div>
    </div>
</x-app-layout>