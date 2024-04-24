@extends('layouts.Penjualan.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>Penjualan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Penjualan</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section produk">
    <div class="row">

        @if ($errors->any())
        <ul style="width: 100%; background: red; padding: 10px">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div class="mb-3">
            <a href="{{ route('export.Excel') }}" class="btn btn-primary">Export Penjualan (.xlsx)</a>
        </div>

        {{-- Columns --}}
        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Table data Produk
                            @if (Auth::check())
                            @if (Auth::user()->role == 'Kasir')
                            <a href="{{ route('penjualan.create') }}" class="btn btn-primary rounded-pill float-end"><i class="bi bi-plus"></i> Buat</a>
                            @else
                            @endif
                            @endif
                        </h5>

                        {{-- Table --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Harga</th>
                                    <th>Dibuat Oleh</th>
                                    @if (Auth::check())
                                    @if (Auth::user()->role == 'Kasir')
                                    <th class="text-center" colspan="3"></th>
                                    @else
                                    <th class="text-center"></th>
                                    @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $dt)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $dt['pelanggan']->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($date)->setTimezone('Asia/Jakarta')->format('Y-m-d,H:i:s')}}</td>
                                    <td>
                                        @foreach ($dt['penjualan']->detailPenjualan as $produk)
                                        {{ $produk->produk ? $produk->produk->product_name : '-' }} {{ $produk->amount }} <br>
                                        @endforeach
                                    </td>
                                    <td>Rp . {{ number_format($dt['penjualan']->price_amount, 0, ',', '.') }}</td>
                                    <td>
                                        @if(isset($dt['penjualan']->user) && isset($dt['penjualan']->user->role))
                                        {{ $dt['penjualan']->user->role }}
                                        @else
                                        No user role available
                                        @endif
                                    </td>
                                    @if (Auth::check())
                                    @if (Auth::user()->role == 'Kasir')
                                    <td class="text-end">
                                        <a href="{{ route('detail.penjualan', $dt['penjualan']->id ) }}" class="btn btn-primary">Lihat</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('penjualan.destroy', $dt['penjualan']->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{ route('detail.penjualan', $dt['penjualan']->id ) }}" class="btn btn-primary">Lihat</a>
                                    </td>
                                    @endif
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection