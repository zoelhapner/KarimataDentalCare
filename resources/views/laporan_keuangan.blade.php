<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="container px-4 mx-auto mt-6">

        <section class="py-4">

            <div class="max-w-screen-2xl mx-auto">

                <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-2xl">

                    {{-- HEADER --}}
                    <div class="px-6 py-5 border-b border-gray-200">

                        {{-- <h1 class="text-2xl font-bold text-gray-800">
                            Laporan Keuangan
                        </h1> --}}

                        <p class="mt-1 text-sm text-gray-500">
                            Ringkasan pemasukan dan pembagian pendapatan klinik
                        </p>

                    </div>

                    {{-- FILTER --}}
                    <div class="p-6 border-b border-gray-200">

                        <form method="GET"
                            class="flex flex-col gap-4 lg:flex-row lg:items-end">

                            <div class="w-full lg:w-64">

                                <label for="start_date"
                                    class="block mb-2 text-sm font-medium text-gray-700">

                                    Mulai Tanggal
                                </label>

                                <input type="date"
                                    id="start_date"
                                    name="start_date"
                                    value="{{ $startDate }}"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            </div>

                            <div class="w-full lg:w-64">

                                <label for="end_date"
                                    class="block mb-2 text-sm font-medium text-gray-700">

                                    Sampai Tanggal
                                </label>

                                <input type="date"
                                    id="end_date"
                                    name="end_date"
                                    value="{{ $endDate }}"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            </div>

                            <button type="submit"
                                class="px-5 py-3 text-sm font-medium text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">

                                Tampilkan

                            </button>

                        </form>

                    </div>

                    {{-- SUMMARY --}}
                    <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-3">

                        {{-- TOTAL --}}
                        <div class="p-5 border border-blue-100 bg-blue-50 rounded-2xl">

                            <p class="text-sm font-medium text-blue-700">
                                Total Pemasukan
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-blue-800">
                                Rp{{ number_format($totalPemasukan, 0, ',', '.') }}
                            </h3>

                        </div>

                        {{-- DOKTER --}}
                        <div class="p-5 border border-green-100 bg-green-50 rounded-2xl">

                            <p class="text-sm font-medium text-green-700">
                                Pembagian Dokter (40%)
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-green-800">
                                Rp{{ number_format($dokterShare, 0, ',', '.') }}
                            </h3>

                        </div>

                        {{-- KLINIK --}}
                        <div class="p-5 border border-purple-100 bg-purple-50 rounded-2xl">

                            <p class="text-sm font-medium text-purple-700">
                                Pendapatan Klinik (60%)
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-purple-800">
                                Rp{{ number_format($klinikShare, 0, ',', '.') }}
                            </h3>

                        </div>

                    </div>

                    {{-- DETAIL TRANSAKSI --}}
                    <div class="p-6 border-t border-gray-200">

                        <div class="flex items-center justify-between mb-5">

                            <h4 class="text-lg font-semibold text-gray-800">
                                Detail Transaksi
                            </h4>

                        </div>

                        <div class="overflow-x-auto border border-gray-200 rounded-2xl">

                            <table class="w-full text-sm text-left text-gray-700">

                                <thead class="text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-50">

                                    <tr>

                                        <th class="px-6 py-4">
                                            Nama Dokter
                                        </th>

                                        <th class="px-6 py-4">
                                            Total Transaksi
                                        </th>

                                        <th class="px-6 py-4">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-4">
                                            Jam
                                        </th>

                                    </tr>

                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">

                                    @foreach ($transaksi as $item)

                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $item->tindakan->dokter->nama_dokter }}
                                        </td>

                                        <td class="px-6 py-4">
                                            Rp{{ number_format($item->total_biaya, 0, ',', '.') }}
                                        </td>

                                        {{-- <td class="px-6 py-4 text-gray-500">
                                            {{ $item->created_at }}
                                        </td> --}}
                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $item->tindakan->tanggal_visit_formatted }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $item->tindakan->jam }}
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                    {{-- PENDAPATAN DOKTER --}}
                    <div class="p-6 border-t border-gray-200">

                        <h4 class="mb-5 text-lg font-semibold text-gray-800">
                            Estimasi Pendapatan Dokter
                        </h4>

                        <div class="overflow-x-auto border border-gray-200 rounded-2xl">

                            <table class="w-full text-sm text-left text-gray-700">

                                <thead class="text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-50">

                                    <tr>

                                        <th class="px-6 py-4">
                                            Nama Dokter
                                        </th>

                                        <th class="px-6 py-4">
                                            Estimasi Pendapatan
                                        </th>

                                    </tr>

                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">

                                    @foreach ($dokters as $dokter)

                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-6 py-4 font-medium text-gray-800">
                                            {{ $dokter->nama_dokter }}
                                        </td>

                                        <td class="px-6 py-4 text-green-700 font-semibold">
                                            Rp{{ number_format($dokter->biaya, 0, ',', '.') }}
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>
</x-app-layout>