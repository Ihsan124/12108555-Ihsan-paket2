@extends('layouts.app')

@section('content')
{{-- Page Title --}}
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->
<section class="section dashboard">
    <div class="row">

        @if ($message = Session::get('Success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($message = Session::get('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="card">
                    <div style="margin: 20px">
                        <h3>Hello, {{ Auth::user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End columns -->

        @if (Auth::check())
        @if (Auth::user()->role == 'Admin')

        {{-- Card Data Produk --}}
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 350px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/stacked-cardboard-boxes (1).jpg') }}" alt="Data Produk" style="width: 500px">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">Data Produk</h5>
                    <h5 class="card-text" style="text-align: center;"><a href="/produk" class="btn btn-success rounded-pill">Lihat</a></h5>
                </div>
            </div>
        </div>
        {{-- End Card Data Produk --}}

        {{-- Card Data Penjualan --}}
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 350px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/penjualan.jpg') }}" alt="Data Produk" style="width: 550px">
</div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">Data Penjualan</h5>
                    <h5 class="card-text" style="text-align: center;"><a href="/penjualan" class="btn btn-success rounded-pill">Lihat</a></h5>
                </div>
            </div>
        </div>
        {{-- End Card Data Penjualan --}}

        {{-- Card Data User --}}
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 350px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/news-5.jpg') }}" alt="Data Produk" style="width: 500px">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">Data User</h5>
                    <h5 class="card-text" style="text-align: center;"><a href="/user" class="btn btn-success rounded-pill">Lihat</a></h5>
                </div>
            </div>
        </div>
        {{-- End Card Data User --}}

        @else
        {{-- Card Data Produk --}}
        <div class="col-lg-6">
            <div class="card">
                <div style="height: 350px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/card.jpg') }}" alt="Data Produk" style="width: 500px">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">Data Produk</h5>
                    <h5 class="card-text" style="text-align: center;"><a href="/produk" class="btn btn-success rounded-pill">Lihat</a></h5>
                </div>
            </div>
        </div>
        {{-- End Card Data Produk --}}

        {{-- Card Data Penjualan --}}
        <div class="col-lg-6">
            <div class="card">
                <div style="height: 350px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img src="{{ asset('assets/img/penjualan.jpg') }}" alt="Data Produk" style="width: 550px">
                </div>
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center;">Data Penjualan</h5>
                    <h5 class="card-text" style="text-align: center;"><a href="/penjualan" class="btn btn-success rounded-pill">Lihat</a></h5>
                </div>
            </div>
        </div>
        {{-- End Card Data Penjualan --}}
        @endif
        @endif
    </div>
</section>

@endsection