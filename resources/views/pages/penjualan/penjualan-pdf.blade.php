<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Penjualan</title>
    <style>
        #back-wrap {
            margin: 30px auto 0 30px;
            width: 450px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 500px;
            background: #fff;
        }

        h2 {
            font-size: .9rem;
        }

        p {
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top {
            margin-top: 25px;
        }

        #top .info {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px dolif #eee;
        }

        .tabletitle {
            font-size: .5rem;
            background: #eee;
        }

        .service {
            border-bottom: 1px solid #eee;
        }

        .itemtext {
            font-size: .7rem;
        }

        #legalcopy {
            margin-top: 15px;
        }

        .btn-print {
            float: right;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="back-wrap">
    </div>
    <div id="receipt">
        <center id="top">
            <h2 style="color: darkblue;">MiniMarket</h2>
        </center>
        <div id="mid">
            <div class="info">
                <br>
                Nama Pelanggan : {{ $penjualan->pelanggan->name }} </br>
                Alamat Pelanggan : {{ $penjualan->pelanggan->address }} </br>
                No HP Pelanggan : {{ $penjualan->pelanggan->no_telp }} </br>
                Tanggal Transaksi :{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}</br>
                <p></p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Product Name</h2>
                        </td>
                        <td class="item">
                            <h2>Quantity</h2>
                        </td>
                        <td class="item">
                            <h2>Price</h2>
                        </td>
                        <td class="item">
                            <h2>Subtotal</h2>
                        </td>
                    </tr>
                    @foreach ($detail as $item)
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">{{ $item->produk->product_name }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $item['amount'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp{{ number_format($item->produk->price, 0, ',' . '.') }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp{{ number_format($item['sub_total'], 0, ',' . '.') }}</p>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td>
                            <h2>Total :</h2>
                        </td>
                        <td>
                            <h2>Rp. {{ number_format($penjualan->price_amount, 0, ',' . '.') }}</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="">
                <h2>Total : Rp{{ number_format($penjualan->total_price, 0, ',' . '.') }}</h2>
                <h2>Pembayaran : Rp{{ number_format($penjualan->payment, 0, ',' . '.') }}</h2>
                <h2>Kembalian : Rp{{ number_format($penjualan->return, 0, ',' . '.') }}</h2>
            </div>
            <div id="legalcopy">
                <center>
                    <p>Hormat Kami | Ksair</p>
                    <p class="legal"><strong>Terima kasih telah membeli produk Kami!</strong></p>
                </center>
            </div>
        </div>
    </div>
</body>

</html>