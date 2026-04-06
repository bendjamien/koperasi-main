<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0ea5e9; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #0ea5e9; text-transform: uppercase; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .stats { margin-bottom: 30px; background: #f8fafc; padding: 15px; border-radius: 8px; }
        .stats table { width: 100%; }
        .stats td { padding: 5px; }
        .stats .label { font-weight: bold; color: #64748b; }
        .stats .value { font-weight: 800; color: #0f172a; text-align: right; }
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th { background: #0ea5e9; color: white; padding: 10px; text-align: left; text-transform: uppercase; font-size: 10px; }
        table.data td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
        .text-right { text-align: right; }
        .footer { margin-top: 50px; text-align: right; font-style: italic; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Pendapatan</h1>
        <p>Sistem Koperasi Digital</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td><strong>Periode:</strong> {{ $startDate ?: 'Semua' }} s/d {{ $endDate ?: 'Semua' }}</td>
                <td align="right"><strong>Dicetak pada:</strong> {{ now()->isoFormat('D MMMM Y, HH:mm') }}</td>
            </tr>
        </table>
    </div>

    <div class="stats">
        <table>
            <tr>
                <td class="label">Total Akumulasi Transaksi</td>
                <td class="value">Rp{{ number_format($totalFiltered, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Jumlah Transaksi</td>
                <td class="value">{{ $transaksis->count() }} Transaksi</td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Metode</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $trx)
            <tr>
                <td>#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y H:i') }}</td>
                <td>{{ $trx->pelanggan->nama ?? 'Umum' }}</td>
                <td>{{ $trx->metode_bayar }}</td>
                <td class="text-right">Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem pada {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
