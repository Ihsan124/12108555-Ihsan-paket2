<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div id="back-warp">
        <a href="{{ route('penjualan.index') }}" class="btn-back">Kembali</a>
    </div>

    <div id="receipt">
        <a href="" class="btn-print">Cetak (.pdf)</a>
        <center id="top">
            <h2>MiniMarket</h2>
        </center>
        <div id="mid">
            <div class="info">
                <br>
                Nama Pelanggan : {{ $penjualan->pelanggan->name}}
                <br>
                Alamat Pelanggan : {{ $penjualan->pelanggan->address }}
                <br>
                No HP Pelanggan : {{ $penjualan->pelanggan->no_telp }}
                <br>
                <p></p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tbody>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Nama Produk</h2>
                            </td>
                            <td class="item">
                                <h2>Qty</h2>
                            </td>
                            <td class="item">
                                <h2>Harga</h2>
                            </td>
                            <td class="item">
                                <h2>Sub Total</h2>
                            </td>
                        </tr>
                        @foreach ($penjualan as $produk)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $produk->product_name}}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>