<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - MINIMARKET</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('pages.Login.link')
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        @if ($message = Session::get('Error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            @if ($errors->any())
                            <ul style="width: 100%; background: red; padding: 10px;">
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif

                            <div class="d-flex justify-content-center py-4">
                                <a href="dashboard" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">MiniMarket</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Silahkan Login</h5>
                                        <p class="text-center small">Masukan Email & Password Buat Login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ route('login.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="" class="form-label">E-mail</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="email" class="form-control" required>
                                                <!-- <div class="invalid-feedback">Please enter your e-mail.</div> -->
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                            <!-- <div class="invalid-feedback">Please enter your password!</div> -->
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                 <a href=>Muhamad Ihsan Rasyidin</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    <!-- End #main -->

    @include('pages.Login.script')
</body>

</html>