@extends('layouts.Produk.app')

@section('content')
    <!-- Page Title --->
    <div class="pagetitle">
        <h1>Produk (Create)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
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
                            <h5 class="card-title">Produk Form <a href="{{ route('produk.index') }}" class="btn btn-secondary rounded-pill float-end">Back</a></h5>
                            <form class="row g-3" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="picture" class="form-label">Foto Produk  <span style="color: red">*</span></label>
                                    <input type="file" name="picture" class="form-control" required>
                                </div>

                                <div class="col-12">
                                    <label for="product_name" class="form-label">Nama Produk <span style="color: red">*</span></label>
                                    <input type="text" name="product_name" class="form-control" placeholder="Masukan Nama Produk" required>
                                </div>

                                <div class="col-12">
                                    <label for="price" class="form-label">Harga Produk  <span style="color: red">*</span></label>
                                    <input type="text" name="price" class="form-control" placeholder="0" required>
                                </div>

                                <div class="col-12">
                                    <label for="stock" class="form-label">Stok Produk  <span style="color: red">*</span></label>
                                    <input type="text" name="stock" class="form-control" placeholder="0" required>
                                </div>

                                <div class="col-12">
                                <label for="address" class="form-label">Deskripsi<span style="color: red">*</span></label>
                                <textarea name="deskripsi" class="form-control" placeholder="deskripsi" required></textarea>
                                <!-- <input type="text" name="deskripsi" id="address"> -->
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
