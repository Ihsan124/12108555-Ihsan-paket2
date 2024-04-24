@extends('layouts.Produk.app')

@section('content')
<!-- Page Title --->
    <div class="pagetitle">
        <h1>Produk (Edit)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
                            <h5 class="card-title">Produk Form <a href="{{ route('produk.index') }}" class="btn btn-secondary rounded-pill float-end">Back</a></h5>
                            <form class="row g-3" action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="col-12">
                                    <label for="picture" class="form-label">Foto Produk  <span style="color: red">*</span></label>
                                    <input type="file" name="picture" class="form-control" value="{{ asset('/asset/img/produk/', $produk->picture) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="current_picture" class="form-label"></label>
                                    <img src="{{ asset('/assets/img/product/'.$produk->picture) }}" alt="Current Picture" style="max-width: 200px;">
                                </div>
                                <div class="col-12">
                                    <label for="product_name" class="form-label">Nama Produk <span style="color: red">*</span></label>
                                    <input type="text" name="product_name" class="form-control" value="{{ $produk->product_name }}"  required>
                                </div>

                                <div class="col-12">
                                    <label for="price" class="form-label">Harga Produk  <span style="color: red">*</span></label>
                                    <input type="text" name="price" class="form-control" value="{{ $produk->price }}" required>
                                </div>

                                <div class="col-12">
                                    <label for="stock" class="form-label">Stok Produk  <span style="color: red">*</span></label>
                                    <input type="text" name="stock" class="form-control" value="{{ $produk->stock }}" disabled required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" style="width: 250px;"><i class="bi bi-send"></i> Kirim</button>
                                    <button type="reset" class="btn btn-danger" style="width: 250px;"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
