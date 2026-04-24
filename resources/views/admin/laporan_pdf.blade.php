<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Eramet Beyond Scholarship</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.6; }
        h2 { text-align: center; text-transform: uppercase; margin-bottom: 20px; }
        .user-section { margin-top: 25px; page-break-inside: avoid; }
        .user-info { margin-bottom: 10px; padding: 10px; background: #f8f9fa; border-left: 4px solid #0d2451; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>

    <h2>Laporan Penggunaan Dana Eramet Beyond Scholarship</h2>

    {{-- BARIS PENTING: Membuka loop dan mengelompokkan laporan berdasarkan Mahasiswa --}}
    @foreach($allReports->groupBy('user_id') as $userId => $userReports)
        @php
            $firstReport = $userReports->first();
            $user = $firstReport->user; // Mengambil data user dari laporan pertama dalam grup
            $totalPerUser = $userReports->sum('harga'); // Menghitung total dana per mahasiswa
        @endphp

        <div class="user-section">
            <div class="user-info">
                <span class="fw-bold">Nama Mahasiswa:</span> {{ $user->name ?? 'N/A' }} <br>
                <span class="fw-bold">NIM:</span> {{ $user->nim ?? '-' }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="45%">Item / Deskripsi</th>
                        <th width="25%">Kategori</th>
                        <th width="25%">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userReports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->nama_item }}</td>
                        <td>{{ strtoupper(str_replace('_', ' ', $report->jenis_laporan)) }}</td>
                        <td class="text-right">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right fw-bold">Total Penggunaan</td>
                        <td class="text-right fw-bold">Rp {{ number_format($totalPerUser, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endforeach

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: {{ date('d F Y') }}</p>
        <h3 class="fw-bold">Total Dana Keseluruhan: Rp {{ number_format($allReports->sum('harga'), 0, ',', '.') }}</h3>
    </div>

</body>
</html>