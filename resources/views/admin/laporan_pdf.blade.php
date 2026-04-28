<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Eramet Beyond Scholarship</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; line-height: 1.6; }

        .header-table { width: 100%; border: none; margin-bottom: 20px; }
        .header-table td { border: none; padding: 0; vertical-align: middle; }
        .header-left { text-align: left; width: 25%; }
        .header-center { text-align: center; width: 50%; }
        .header-right { text-align: right; width: 25%; }
        .header-logo { height: 70px; }
        h2 { text-transform: uppercase; margin: 0; font-size: 16px; }
        .header-sub { font-size: 12px; color: #333; margin-top: 4px; }

        .user-section { margin-top: 25px; page-break-inside: avoid; }
        .user-info { margin-bottom: 10px; padding: 10px; background: #f8f9fa; border-left: 4px solid #0d2451; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }

        .item-table { width: 100%; border: none; margin: 0; }
        .item-table td { border: none; padding: 0; vertical-align: middle; }
        .item-name { font-weight: bold; }
        .item-desc { font-size: 11px; color: #333; font-style: italic; text-align: right; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="header-left">
                @php
                    $logoEratme = public_path('images/logo-eratme.jpg');
                @endphp
                @if(file_exists($logoEratme))
                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($logoEratme)) }}" class="header-logo" alt="Logo Eramet">
                @endif
            </td>
            <td class="header-center">
                <h2>Laporan Penggunaan Dana</h2>
                <div class="header-sub">Eramet Beyond Scholarship</div>
            </td>
            <td class="header-right">
                @php
                    $logoKbf = public_path('images/logo-kbf.png');
                @endphp
                @if(file_exists($logoKbf))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($logoKbf)) }}" class="header-logo" alt="Logo KBF">
                @endif
            </td>
        </tr>
    </table>

    @foreach($allReports->groupBy('user_id') as $userId => $userReports)
        @php
            $firstReport = $userReports->first();
            $user = $firstReport->user;
            $totalPerUser = $userReports->sum('harga');
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
                        <th width="25%">Item</th>
                        <th width="45%">Deskripsi</th>
                        <th width="25%">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userReports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="item-name">{{ $report->nama_item }}</td>
                        <td>{{ $report->ringkasan_buku ?? $report->keterangan ?? '-' }}</td>
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
