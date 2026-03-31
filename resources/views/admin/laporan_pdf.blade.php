<!DOCTYPE html>
<html>
<head>
    <title>Laporan Beasiswa Eratme</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { bg-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENGGUNAAN DANA BEASISWA ERATME</h2>
        <p>Dicetak pada: {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Item</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
       <tbody>
            @php $lastUser = null; @endphp
            @foreach($reports as $key => $report)
                
                {{-- Jika nama mahasiswa berbeda dengan baris sebelumnya, kasih baris judul nama --}}
                @if($lastUser !== $report->user->name)
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="6" style="text-align: left; padding-left: 10px;">
                            NAMA MAHASISWA: {{ strtoupper($report->user->name) }}
                        </td>
                    </tr>
                    @php $lastUser = $report->user->name; @endphp
                @endif

                <tr>
                    <td style="text-align: center;">{{ $key + 1 }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->nama_item }}</td>
                    <td>{{ strtoupper($report->jenis_laporan) }}</td>
                    <td>Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                    <td>{{ $report->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">TOTAL PENGELUARAN</th>
                <th colspan="2">Rp {{ number_format($totalDana, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><b>Admin Beasiswa Eratme</b></p>
    </div>
</body>
</html>