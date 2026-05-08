<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 px-4 py-6 bg-white shadow-lg rounded-lg">
        <form action="{{ route('kasir.update', $kasir->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Total Biaya -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Total Biaya:</label>
                <div class="flex justify-between items-center">
                    <span class="text-9xl font-bold text-indigo-600">{{ number_format($kasir->total_biaya, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Jumlah Dibayar -->
            <div class="mb-6">
                <label for="dibayar" class="block text-lg font-medium text-gray-700">Jumlah Dibayar:</label>
                <input type="number" name="dibayar" id="dibayar" class="mt-1 border border-gray-300 rounded-lg p-3 w-full text-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all" value="{{ old('dibayar', $kasir->dibayar) }}" required>
            </div>

            <!-- Kembalian -->
            <div class="mb-6">
                <label for="kembalian" class="block text-lg font-medium text-gray-700">Kembalian:</label>
                <input type="text" id="kembalian" class="mt-1 border border-gray-300 rounded-lg p-3 w-full bg-gray-100 text-xl font-semibold text-green-600" readonly>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-6">
                <label for="metode_pembayaran" class="block text-lg font-medium text-gray-700">Metode Pembayaran:</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 border border-gray-300 rounded-lg p-3 w-full text-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                    <option value="tunai" {{ old('metode_pembayaran', $kasir->metode_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="qris" {{ old('metode_pembayaran', $kasir->metode_pembayaran) == 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="transfer" {{ old('metode_pembayaran', $kasir->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="edc" {{ old('metode_pembayaran', $kasir->metode_pembayaran) == 'edc' ? 'selected' : '' }}>EDC</option>
                </select>
            </div>

            <!-- Button Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('kasir.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-lg shadow-md transition-all hover:scale-105">
                    Kembali
                </a>
                <button type="submit" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-blue font-bold py-2 px-6 rounded-lg shadow-md transition-all hover:scale-105">
                    Bayar
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let totalBiaya = @json($kasir->total_biaya);
            document.getElementById('dibayar').addEventListener('input', function () {
                let dibayar = parseFloat(this.value) || 0;
                let kembalian = dibayar - totalBiaya;
                document.getElementById('kembalian').value = kembalian >= 0 ? kembalian.toLocaleString('id-ID') : '0';
            });
        });
    </script>
</x-app-layout>
