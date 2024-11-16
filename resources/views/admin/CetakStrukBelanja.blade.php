<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Transaksi</title>
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 12pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            font-size: 11pt;
            padding: 5px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .header, .footer {
            margin: 20px;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <h2 style="margin-bottom: 5px;">TOKO PAKAIAN RAFI</h2>
        <p>JL Talagasari, No. 35, Kawalimukti, Kawali, Kawalimukti, Ciamis, Kabupaten Ciamis, Jawa Barat 46253</p>
    </div>
    <br>
    <div style="margin: 20px;">
        <div>
            <p style="float: left;">{{ $t_detail->created_at->format('d-m-Y') }}</p>
            <p style="float: right;">{{ $t_detail->user->name }}</p>
        </div>
        <div class="clear-both" style="clear: both;"></div>
        <p>No: {{ $t_detail->no_transaksi }}</p>
        <p class="text-center">====================================</p>
        <br>
        <table>
          @foreach ($t_detail->transaksidetail as $item)
            <tr>
                <td colspan="3">{{ $item->barang->nm_barang }}</td>
                <td>{{ $item->qty }} x Rp {{ formatRupiah($item->barang->harga) }}</td>
                <td></td>
                <td class="text-right">{{ formatRupiah($item->subtotal) }}</td>
            </tr>
          @endforeach
        </table>
        <p class="text-center">-----------------------------------</p>
        <table>
            <tr>
                <td>Total Item:</td>
                <td class="text-right">{{ $total_item }}</td>
            </tr>
            <tr>
                <td>Total Harga:</td>
                <td class="text-right">{{ formatRupiah($t_detail->total) }}</td>
            </tr>
            <tr>
                <td>Diterima:</td>
                <td class="text-right">{{ formatRupiah($t_detail->dibayarkan) }}</td>
            </tr>
            <tr>
                <td>Kembali:</td>
                <td class="text-right">{{ formatRupiah($t_detail->dibayarkan - $t_detail->total)}}</td>
            </tr>
        </table>
        <p class="text-center">====================================</p>
        <p class="text-center"> -- TERIMA KASIH --</p>
    </div>
     <script type="text/javascript">
        window.print()
    </script>
</body>
</html>
