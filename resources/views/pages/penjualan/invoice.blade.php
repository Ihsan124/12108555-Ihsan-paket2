@extends('layouts.Penjualan.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>Penjualan (Invoice)</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/penjualan">Penjualan</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section produk">
    <div class="row">

        @if ($message = Session::get('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($message = Session::get('Success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <ul style="width: 100%; background: red; padding: 10px">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Invoice data Penjualan <a href="{{ route('penjualan.index') }}" class="btn btn-secondary float-end">Kembali</a></h5>
                        <div id="mid">
                            <h5 class="text-danger">Data Pelanggan</h5>
                            Nama Pelanggan : {{ $penjualan->pelanggan->name }}
                            <br>
                            Alamat Pelanggan : {{ $penjualan->pelanggan->address }}
                            <br>
                            No HP Pelanggan : {{ $penjualan->pelanggan->no_telp }}
                            <br>
                            Tanggal Transaksi :{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}
                            <br>
                            <hr>
                            <br>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harag</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $dt)
                                <tr>
                                    <td>{{ $dt->produk->product_name }}</td>
                                    <td>{{ $dt->amount }}</td>
                                    <td>Rp. {{ number_format($dt->produk->price, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($dt->sub_total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <form class="row g-3" action="{{ route('invoice.store', $penjualan->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-6">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="total_price" id="total_price" value="{{ $penjualan->total_price }}" required hidden>
                                <p>
                                    <strong>Rp. {{ number_format($penjualan->total_price, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Pembayaran <span style="color: red;">*</span></label>
                                <input type="number" class="form-control" name="payment" id="payment" required>
                            </div>

                        <div class="card-footer">
                            <div class="text-center">
                            <button onclick="submitAndDownload()">Submit & Unduh PDF</button>
                            <a href="/penjualan" class="btn btn-secondary">Kembali</a>
                             </div>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <div id="kembalian">Kembalian: Rp {{ $penjualan->return}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
    document.getElementById('payment').addEventListener('input', function() {
        var total_price = parseFloat(document.getElementById('total_price').value);
        var payment = parseFloat(this.value);
        var kembalian = payment - total_price;
        document.getElementById('kembalian').innerText = 'Kembalian: Rp ' + kembalian.toFixed(2);
    });

</script>

<script>
    function submitAndDownload() {
        // Mengirim formulir
        document.getElementById('invoice_form').submit();

        // Membuka tab baru untuk mengunduh PDF
        var pdfUrl = "{{ route('export.PDF', $penjualan->id) }}";
        window.open(pdfUrl, '_blank');
    }
</script>
@endsection