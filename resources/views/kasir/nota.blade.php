<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Kwitansi</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        @media print {
            @page {
                size: A5 landscape;
                margin: 10mm;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #222;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .header-table,
        .info-table,
        .main-table,
        .kasus-table,
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td,
        .info-table td {
            vertical-align: top;
        }

        .clinic-name {
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-title {
            font-size: 16px;
            font-weight: bold;
        }

        .section-space {
            margin-top: 15px;
        }

        .main-table th,
        .main-table td,
        .kasus-table th,
        .kasus-table td {
            border: 1px solid #999;
            padding: 6px;
        }

        .main-table th,
        .kasus-table th {
            background: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary td {
            padding: 5px;
        }

        .signature {
            padding-top: 40px;
        }

        .note {
            text-align: center;
            margin-top: 10px;
            font-style: italic;
            color: #666;
        }

        hr {
            border: none;
            border-top: 1px dashed #999;
            margin: 10px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <table class="header-table">
        <tr>

            <td width="65%">
                <div class="clinic-name">
                    Karimata Dental Care
                </div>

                <div>
                    Jl. Karimata No.7C, Gumuk Kerang, Sumbersari, Jember
                </div>

                <div>
                    Telp: +62 821-3520-1915
                </div>
            </td>

            <td width="35%" class="text-right">
                <div class="invoice-title">
                    NOTA KWITANSI
                </div>

                <div>
                    No Transaksi : {{ $kasir->id }}
                </div>

                <div>
                    Tanggal : {{ now()->format('d/m/Y') }}
                </div>
            </td>

        </tr>
    </table>

    <hr>

    <table class="info-table section-space">
        <tr>

            <td width="70%">
                <strong>Nama Pasien :</strong>
                {{ $kasir->tindakan->pasien->nama_pasien ?? '-' }}
                <br>

                <strong>Alamat :</strong>
                {{ $kasir->tindakan->pasien->alamat_pasien ?? '-' }}
            </td>

            <td width="30%">
                <strong>No HP :</strong>
                {{ $kasir->tindakan->pasien->nohp ?? '-' }}
            </td>

        </tr>
    </table>

    <table class="main-table section-space">

        <thead>
            <tr>
                <th>Dokter</th>
                <th>Tindakan Umum</th>
                <th>Total</th>
                <th>Dibayar</th>
                <th>Kembalian</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>
                    {{ $kasir->tindakan->dokter->nama_dokter ?? '-' }}
                </td>

                <td>
                    {{ $kasir->tindakan->tindakan }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($kasir->total_biaya, 0, ',', '.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($kasir->dibayar, 0, ',', '.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($kasir->kembalian, 0, ',', '.') }}
                </td>
            </tr>

        </tbody>

    </table>

    <table class="summary section-space">

        <tr>
            <td width="80%" class="text-right">
                Biaya Admin
            </td>

            <td width="20%" class="text-right">
                Rp 0
            </td>
        </tr>

        <tr>
            <td class="text-right">
                <strong>Total Dibayar</strong>
            </td>

            <td class="text-right">
                <strong>
                    Rp {{ number_format($kasir->total_biaya, 0, ',', '.') }}
                </strong>
            </td>
        </tr>

        <tr>
            <td class="text-right">
                Metode Pembayaran
            </td>

            <td class="text-right">
                {{ $kasir->metode_pembayaran }}
            </td>
        </tr>

    </table>

    <div class="section-space">
        <strong>Detail Kasus</strong>
    </div>

    <table class="kasus-table section-space">

        <thead>
            <tr>
                <th width="40%">Kasus</th>
                <th width="40%">Tindakan</th>
                <th width="20%">Biaya</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($kasir->tindakan->kasus as $kasus)

            <tr>

                <td>
                    {{ $kasus->kasus }}
                </td>

                <td>
                    {{ $kasus->tindakan_khusus }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($kasus->biaya, 0, ',', '.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <div class="note">
        Semoga sehat selalu 😊
    </div>

    <table class="footer-table section-space">

        <tr>

            <td width="50%" class="text-center signature">
                Diterima Oleh
                <br><br><br>

                (...................................)
            </td>

            <td width="50%" class="text-center signature">
                Tanda Tangan
                <br><br><br>

                (...................................)
            </td>

        </tr>

    </table>

</div>

<script>
    window.print();
</script>

</body>
</html>