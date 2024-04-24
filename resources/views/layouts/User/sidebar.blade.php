<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if (Auth::check())
            @if (Auth::user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/produk">
                    <i class="bi bi-shop"></i>
                    <span>Produk</span>
                </a>
            </li>
            <!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/penjualan">
                    <i class="bi bi-cart-plus"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="bi bi-person"></i>
                    <span>User</span>
            </a>
        </li>
        <!-- End Error 404 Page Nav -->
        @else
        <li class="nav-item">
                <a class="nav-link collapsed" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/produk">
                    <i class="bi bi-shop"></i>
                    <span>Produk</span>
                </a>
            </li>
            <!-- End Error 404 Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="/penjualan">
                    <i class="bi bi-cart-plus"></i>
                    <span>Penjualan</span>
                </a>
            </li>
            <!-- End Error 404 Page Nav -->
        @endif
    @endif

    </ul>

</aside>
<!-- End Sidebar-->
