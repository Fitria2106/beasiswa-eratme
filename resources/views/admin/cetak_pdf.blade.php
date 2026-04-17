<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan Buku & ATK</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; margin: 0; padding: 0; }
        .header-table { width: 100%; border-bottom: 3px double #000; margin-bottom: 20px; }
        .header-table td { border: none; vertical-align: middle; text-align: center; }
        
        .logo { width: 65px; height: auto; }
        .kop-text { line-height: 1.2; }
        .kop-text h2 { margin: 0; font-size: 16px; color: #1a1a1a; }
        .kop-text h3 { margin: 5px 0; font-size: 14px; }
        .kop-text p { margin: 0; font-size: 10px; color: #555; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f2f2f2; border: 1px solid #000; padding: 8px; text-align: center; }
        td { border: 1px solid #000; padding: 6px; }
        
        .bg-gray { background-color: #fafafa; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { background-color: #eee; font-weight: bold; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td width="15%">
                @php
                    $pathEratme = public_path('images/logo-eratme.png');
                    $base64Eratme = file_exists($pathEratme) ? 'data:image/png;base64,' . base64_encode(file_get_contents($pathEratme)) : null;
                @endphp
                @if($base64Eratme) <img src="{{ $base64Eratme }}" class="logo"> @endif
            </td>
            <td width="70%" class="kop-text">
                <h2>BEASISWA ERATME</h2>
                <h3>LAPORAN KEUANGAN PENGGUNAAN DANA BUKU & ATK</h3>
                <p>Alamat: Jakarta Selatan| Email: info@eratme.com | Periode: {{ date('Y') }}</p>
            </td>
            <td width="15%">
                @php
                    $pathKbf = public_path('images/logo-kbf.png'); // Pastikan file logo-kbf.png ada di folder public/images/
                    $base64Kbf = file_exists($pathKbf) ? 'data:image/png;base64,' . base64_encode(file_get_contents($pathKbf)) : null;
                @endphp
                @if($base64Kbf) <img src="{{ $base64Kbf }}" class="logo"> @endif
            </td>
        </tr>
    </table>

    <p class="text-right">Tanggal Cetak: {{ date('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Mahasiswa / NIM</th>
                <th>Item / Deskripsi Laporan</th>
                <th width="10%">Semester</th>
                <th width="15%">Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; $no = 1; @endphp
            @foreach($grouped_reports as $userId => $userReports)
                @php 
                    $user = $userReports->first()->user; 
                    $subTotal = $userReports->sum('harga');
                    $grandTotal += $subTotal;
                @endphp
                
                <tr class="bg-gray">
                    <td class="text-center">{{ $no++ }}</td>
                    <td>
                        <strong>{{ strtoupper($user->name) }}</strong><br>
                        <span>NIM: {{ $user->nim }}</span>
                    </td>
                    <td colspan="3">Jurusan: {{ $user->jurusan }}</td>
                </tr>

                @foreach($userReports as $report)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{ $report->nama_item }}<br>
                        <small><em>{{ $report->ringkasan_buku ?? $report->keterangan }}</em></small>
                    </td>
                    <td class="text-center">{{ $report->semester }}</td>
                    <td class="text-right">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="4" class="text-right">Sub-Total Penggunaan {{ $user->name }}</td>
                    <td class="text-right">Rp {{ number_format($subTotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #333; color: white;">
                <td colspan="4" class="text-right"><strong>TOTAL KESELURUHAN DANA TERPAKAI</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 50px; float: right; width: 200px; text-align: center;">
        <p>Yogyakarta, {{ date('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Admin Beasiswa Eratme</strong></p>
    </div>

</body>
</html>