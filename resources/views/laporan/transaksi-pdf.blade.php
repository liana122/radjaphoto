
<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Tgl Pesan</th>
                <th>Jml Pesan</th>
                <th>Harga Satuan</th>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>
                        {{ $result->type }}
                    </td>
                    <td>
                        {{ $result->keterangan }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($result->tgltransaksi)->format('d F Y') }}
                    </td>
                    <td>
                        {{ $result->jumlahpesanan }}
                    </td>
                    <td>
                        {{ number_format($result->harga) }}
                    </td>
                    <td>
                        {{ number_format($result->total) }}
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="5">Grand Total</td>
                    <td class="total">{{ number_format($results->sum('total')) }}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>