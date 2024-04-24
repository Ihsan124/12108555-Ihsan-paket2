@extends('layouts.Penjualan.app')

@section('content')
<!-- Basic Modal -->
<div class="card">
    <div class="card-body">
        <h6 class="card-title">Detail Penjualan</h6>
        <hr>
        <h4 class="text-center" style="color: darkblue;"> <strong>MiniMarket</strong></h4>
        <div class="row">
            <p>
                Nama Pelanggan : <strong>{{ $penjualan->pelanggan->name }}</strong>
                <br>
                Alamat Pelanggan : <strong>{{ $penjualan->pelanggan->address }}</strong>
                <br>
                No HP Pelanggan : <strong>{{ $penjualan->pelanggan->no_telp }}</strong>
                <br>
                Tanggal Transaksi : <strong>{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}</strong>
            </p>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>harga</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $dt)
                <tr>
                    <td>{{ $dt->produk ? $dt->produk->product_name : '-' }}</td>
                    <td>{{ $dt->amount }}</td>
                    <td>Rp. {{ $dt['produk'] ? number_format($dt['produk']->price, 0, ',', '.') : 'Rp. 0' }}</td>
                    <td>Rp. {{ number_format($dt->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <br>
            </tbody>
            <tr>
                <td></td>
                <td></td>
                <th>Total :</th>
                <td>Rp. {{ number_format($penjualan->price_amount, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="">
            <h5>Total : Rp{{ number_format($penjualan->total_price, 0, ',' . '.') }}</h5>
            <h5>Pembayaran : Rp{{ number_format($penjualan->payment, 0, ',' . '.') }}</h5>
            <h5>Kembalian : Rp{{ number_format($penjualan->return, 0, ',' . '.') }}</h5>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-center">
            <a href="{{ route('export.PDF', $penjualan->id) }}" class="btn btn-secondary">Unduh Bukti</a>
            <a href="/penjualan" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<!-- End Basic Modal-->
@endsection