<!-- resources/views/tabel.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Daftar Data Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kasir</th>
                <th>Total</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($DtTransaksi as $item)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $item->user->name }}</td>
                <td>{{ formatRupiah($item->total) }}</td>
                <td>{{ $item->created_at->format('d - m - Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        window.print()
    </script>
</body>
</html>
