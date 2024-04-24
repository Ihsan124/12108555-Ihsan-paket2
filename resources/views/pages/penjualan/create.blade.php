@extends('layouts.Penjualan.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>Penjualan (Create)</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Penjualan</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section produk">
    <div class="row">

        {{-- columns --}}
        <div class="col-lg-12">
            <div class="row">

                @if ($errors->any())
                <ul style="width: 100%; background: red; padding: 10px">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Produk Form <a href="{{ route('penjualan.index') }}" class="btn btn-secondary rounded-pill float-end">Back</a></h5>
                        <form class="row g-3" action="{{ route('penjualan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Pelanggan<span style="color: red">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Pelanggan" required>
                            </div>

                            <div class="col-12">
                                <label for="no_telp" class="form-label">No HP Pelanggan<span style="color: red">*</span></label>
                                <input type="number" name="no_telp" class="form-control" placeholder="08**-****-**" required>
                            </div>

                            

                            <div class="col-12">
                                <label for="address" class="form-label">Alamat Pelanggan<span style="color: red">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Masukan Alamat Pelanggan" required></textarea>
                            </div>

                            <div class="">
                                <div class="chart-area d-flex flex-row flex-wrap">
                                        @foreach ($sell as $sl)
                                        <div class="card text-center mb-3 mr-3 " style="width: 22rem; margin: 10px">
                                                <img class="card-img-top" src=" {{ asset('/assets/img/product/' . $sl->picture) }}" alt="img produk" width="100px">
                                                <div class="card-body">
                                                <h5 class="card-title font-weight-bold text-dark">
                                                    {{ $sl->product_name }}
                                                </h5>
                                                <p class="card-text">Stock {{ $sl->stock }}</p>
                                                <p class="font-weight-bold text-dark"><?php echo ' RP. ' . $sl->price; ?></p>
                                                <div class="product-quantity mb-3">
                                                    <div class="d-flex justify-content-center">
                                                        <button class="minus-btn mr-2 btn btn-primary me-2" type="button">-</button>
                                                        <input class="quantity mr-2 form-control" type="text" name="amount[]" value="0">
                                                        <button class="plus-btn btn btn-primary ms-2" type="button">+</button>
                                                    </div>
                                                </div>
                                                <p class="subtotal">Subtotal: Rp. 0.00</p>
                                                <input type="hidden" name="produk_id[]" value="{{ $sl->id }}">
                                                <input type="hidden" class="harga" name="price[]" value="{{ $sl->price }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>  
                                <!-- Tombol "Selanjutnya" di bawah div "chart-area" -->
                                <div class="chart-area text-center">
                                    {{-- <input type="hidden" name="penjualan_id" value=""> --}}
                                    <button type="submit" class="btn btn-primary " style="width: 250px;">Pesan</button>
                                    <button type="reset" class="btn btn-danger" style="width: 250px;">Reset</button>
                                    
                                </div>
                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.penjualan.script')
</section>
@endsection