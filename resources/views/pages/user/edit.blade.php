@extends('layouts.User.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>User (Edit)</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/user">User</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section user">
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
                        <h5 class="card-title">User Form (Edit) <a href="{{ route('user.index') }}" class="btn btn-secondary rounded-pill float-end">Back</a></h5>
                        <form class="row g-3" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="col-12">
                                <label for="product_name" class="form-label">Nama User <span style="color: red">*</span></label>
                                <input type="text" name="name" placeholder="Ubah Nama Anda" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="col-12">
                                <label for="price" class="form-label">Email User <span style="color: red">*</span></label>
                                <input type="text" name="email" placeholder="Ubah Email Anda" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="col-12">
                                <label for="stock" class="form-label">Password <span style="color: red">*</span></label>
                                <input type="password" name="password" placeholder="Ubah Password Anda" class="form-control" value="{{ $user->password }}" required>
                            </div>

                            <div class="col-12">
                                <label for="stock" class="form-label">Role <span style="color: red">*</span></label>
                                <select name="role" class="form-control" required>
                                    <option selected hidden disabled>Ubah role Anda</option>
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Kasir" {{ $user->role == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
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