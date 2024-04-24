@extends('layouts.Produk.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>Produk (Trash)</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/produk">Produk</a></li>
            <li class="breadcrumb-item active">Trash</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section produk">
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
                    <div class="card-body">
                        <h5 class="card-title">Table data Produk (Trash)<a href="{{ route('produk.index') }}" class="btn btn-secondary rounded-pill float-end"><i class="bi bi-arrow-left"></i> Back</a></h5>

                        <!-- Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($trash as $dt)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="{{ asset('/assets/img/product/' . $dt->picture)}}" target="_blank"><img src="{{ asset('/assets/img/product/' . $dt->picture)}}" width="80"></a> {{ $dt->product_name }}</td>
                                    <td>Rp. {{number_format($dt->price, 0, ',', '.')}}</td>
                                    <td>{{ $dt->stock }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('produk.restore', $dt->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary rounded-pill me-2"><i class="bi bi-arrow-clockwise"></i> Restore</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('produk.permanent', $dt->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-danger rounded-pill"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div><!-- End columns -->

    </div>
</section>
@endsection