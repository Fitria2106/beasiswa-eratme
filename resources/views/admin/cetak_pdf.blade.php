<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header-table { width: 100%; border-bottom: 2px solid #2e59d9; margin-bottom: 20px; padding-bottom: 10px; }
        .header-text { text-align: center; }
        .header-text h2 { margin: 0; color: #2e59d9; font-size: 16px; }
        
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ccc; padding: 6px; vertical-align: top; }
        .table thead th { background-color: #f8f9fa; font-weight: bold; text-align: center; }
        
        .user-header { 
            background-color: #e9ecef; 
            padding: 8px; 
            border: 1px solid #ccc; 
            border-bottom: none; 
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <table class="header-table">


    <td width="15%" align="left">
         {{-- Logo Eratme --}}
         <img src="{{ public_path('images/logo-eratme.jpg') }}" style="height: 50px;">
    </td>
        <tr>
            <td class="header-text">
                <h2>Laporan Pertanggungjawaban Dana Beasiswa</h2>
                <p>Program Beasiswa Eratme x Kitong Bisa Foundation</p>
                
            </td>
        </tr>
    </table>

    @foreach($grouped_reports as $userId => $reports)
        <div class="user-header">
            Nama Mahasiswa: {{ $reports->first()->user->name }} 
            <span style="font-weight: normal; font-size: 10px; float: right;">
                NIM: {{ $reports->first()->user->nim ?? '-' }}
            </span>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th>Rincian Barang/Buku & Ringkasan</th>
                    <th width="100">Harga</th>
                    <th width="80">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPerUser = 0; @endphp
                @foreach($reports as $index => $report)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $report->nama_item }}</strong>
                        <div style="font-size: 9px; color: #555; margin-top:3px;">
                            {{ $report->ringkasan_buku ?? $report->keterangan }}
                        </div>
                    </td>
                    <td align="right">Rp {{ number_format($report->harga, 0, ',', '.') }}</td>
                    <td align="center">{{ $report->created_at->format('d/m/Y') }}</td>
                </tr>
                @php $totalPerUser += $report->harga; @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #f8f9fa;">
                    <td colspan="2" align="right"><strong>Total Penggunaan Dana:</strong></td>
                    <td align="right"><strong>Rp {{ number_format($totalPerUser, 0, ',', '.') }}</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    @endforeach

</body>
</html>