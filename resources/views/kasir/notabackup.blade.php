<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Kwitansi</title>
    <style>
        /* Menyeting layout khusus untuk cetakan dengan orientasi landscape */
        @media print {
            @page {
                size: 14cm 21cm landscape;
                /* Ukuran A5 dengan orientasi landscape */
                margin: 1cm;
            }

            body {
                font-family: tahoma;
                font-size: 8pt;
                margin: 0;
            }

            #tabel {
                font-size: 15px;
                border-collapse: collapse;
            }

            #tabel td {
                padding-left: 5px;
                border: 1px solid black;
            }

            /* Menyesuaikan ukuran tabel agar tidak melampaui halaman */
            table {
                width: 100%;
                page-break-inside: avoid;
            }

            table td {
                word-wrap: break-word;
                overflow-wrap: break-word;
                padding: 5px;
            }

            h3 {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <center>
        <table style='font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                    <span style='font-size:12pt'><b>Karimata Dental Care</b></span><br>
                    Alamat Klinik: Jl. Karimata No.7C, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121<br>
                    Telp: +62 821-3520-1915
                </td>
                <td style='vertical-align:top' width='30%' align='left'>
                    <b><span style='font-size:12pt'>NOTA KWITANSI</span></b><br>
                    No Trans.: {{ $kasir->id }}<br>
                    Tanggal: {{ now()->format('d-m-Y') }}<br>
                </td>
            </tr>
        </table>

        <table style='font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                    Nama Pasien: {{ $kasir->tindakan->pasien->nama_pasien ?? 'N/A' }}<br>
                    Alamat: {{ $kasir->tindakan->pasien->alamat_pasien ?? 'N/A' }}
                </td>
                <td style='vertical-align:top' width='30%' align='left'>
                    No Telp: {{ $kasir->tindakan->pasien->nohp ?? 'N/A' }}
                </td>
            </tr>
        </table>

        <br>

        <table cellspacing='0' style='font-size:8pt; font-family:calibri; border-collapse: collapse;' border='1'>
            <tr align='center'>
                <td width='10%'>Dokter</td>
                <td width='20%'>Tindakan Umum</td>
                <td width='13%'>Total Biaya</td>
                <td width='4%'>Dibayar</td>
                <td width='7%'>Kembalian</td>
            </tr>
            <tr>
                <td>{{ $kasir->tindakan->dokter->nama_dokter ?? 'N/A' }}</td>
                <td>{{ $kasir->tindakan->tindakan }}</td>
                <td style='text-align:right'>{{ number_format($kasir->total_biaya, 0, ',', '.') }}</td>
                <td style='text-align:right'>{{ number_format($kasir->dibayar, 0, ',', '.') }}</td>
                <td style='text-align:right'>{{ number_format($kasir->kembalian, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Biaya Admin:</div>
                </td>
                <td style='text-align:right'>0</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Total Yang Harus Dibayar Adalah:</div>
                </td>
                <td style='text-align:right'>{{ number_format($kasir->total_biaya, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Metode Pembayaran:</div>
                </td>
                <td style='text-align:right'>{{ $kasir->metode_pembayaran }}</td>
            </tr>
            <tr>
                <td colspan='5'>
                    <div style='text-align:right'>Semoga sehat selalu.</div>
                </td>
            </tr>
        </table>

        <h3>Keterangan Kasus:</h3>
        <table cellspacing='0' style='font-size:8pt; font-family:calibri; border-collapse: collapse;' border='1'>
            <tr align='center'>
                <td width='33%'>Kasus</td>
                <td width='33%'>Tindakan</td>
                <td width='33%'>Biaya</td>
            </tr>
            @foreach ($kasir->tindakan->kasus as $kasus)
            <tr>
                <td>{{ $kasus->kasus }}</td>
                <td>{{ $kasus->tindakan_khusus }}</td>
                <td style='text-align:right'>{{ number_format($kasus->biaya, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <table style='font-size:7pt;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,<br><br><u>(....................................)</u></td>
                <td style='border:1px solid white; padding:5px; text-align:left; width:30%'></td>
                <td align='center'>TTD,<br><br><u>(....................................)</u></td>
            </tr>
        </table>
    </center>

    <script>
        window.print();
    </script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Kwitansi</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <style>
        @media print {
            @page {
                size: 14cm 21cm landscape;
                margin: 1cm;
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