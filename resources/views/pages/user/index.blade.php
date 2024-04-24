@extends('layouts.User.app')

@section('content')
<!-- Page Title --->
<div class="pagetitle">
    <h1>User</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<section class="section User">
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
                        <h5 class="card-title">Table data User
                            @if (Auth::check())
                            @if (Auth::user()->role == 'Admin')
                            <a href="{{ route('user.create') }}" class="btn btn-primary rounded-pill float-end"><i class="bi bi-plus"></i>
                                Create</a>
                            @else
                            @endif
                            @endif
                        </h5>

                        <!-- Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Role</th>
                                    @if (Auth::check())
                                    @if (Auth::user()->role == 'Admin')
                                    <th colspan="2"></th>
                                    @else
                                    @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($user as $use)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $use->name }}</td>
                                    <td>{{ $use->email }}</td>
                                    <td>{{ $use->role }}</td>
                                    @if (Auth::check())
                                    @if (Auth::user()->role == 'Admin')
                                    <td class="text-center">
                                        <form action="{{ route('user.destroy', $use->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('user.edit', $use->id) }}" class="btn btn-primary rounded-pill"><i class="bi bi-pencil"></i>
                                                Edit</a>
                                            <button type="submit" class="btn btn-danger rounded-pill"><i class="bi bi-trash-fill"></i> Delete</button>
                                        </form>
                                    </td>
                                    @else
                                    @endif
                                    @endif
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