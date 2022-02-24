
<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Jenis Paket</th>
                <th>Keterangan</th>
                <th>Tgl Pesan</th>
                <th>Jml Pesan</th>
                <th>Harga Satuan</th>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($results->groupBy('id_user') as $users)
                <tr>
                    <td colspan="6">{{ $users[0]->name }}</td>
                </tr>
                @foreach ($users as $result)
                <tr>
                    <td>
                        {{ $result->jenispaket }}
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
                    <td></td>
                    <td colspan="4">Sub Total {{ $users[0]->name }}</td>
                    <td class="total">{{ number_format($users->sum('total')) }}</td>
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