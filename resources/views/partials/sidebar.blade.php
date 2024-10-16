<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image--> <!--end::Brand Image-->
            <!--begin::Brand Text--> <span class="brand-text fw-light">SpeedPart Sistem</span> <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                @if (auth()->user()->role == 'admin')
                    <li class="nav-header">DASHBOARD</li>
                    <li class="nav-item"> <a href="{{ route('app') }}" class="nav-link"> <i
                                class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Dashboard
                                <i class="nav-arrow"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item menu-open"> <a href="#" class="nav-link"> <i
                                class="nav-iconbi bi-clipboard-data-fill"></i>
                            <p>
                                Data Master
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"> <a href="{{ route('user/list') }}" class="nav-link"><i
                                        class="nav-icon bi bi-people"></i>
                                    <p>Data User</p>
                                </a> </li>
                            <li class="nav-item"> <a href="{{ route('jenisbarang/list') }}" class="nav-link"><i
                                        class="nav-icon bi bi-box-seam"></i>
                                    <p>Data Jenis Barang</p>
                                </a> </li>
                            <li class="nav-item"> <a href="{{ route('barang/list') }}" class="nav-link"><i
                                        class="nav-icon bi bi-boxes"></i>
                                    <p>Data Barang</p>
                                </a> </li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->role == 'operator')
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item menu-open"> <a href="#" class="nav-link"> <i
                                class="nav-icon bi bi-currency-bitcoin"></i>
                            <p>
                                Data Transaksi
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"> <a href="{{ route('transaksi/list') }}" class="nav-link"> <i
                                        class="nav-icon bi bi-cart-check"></i>
                                    <p>Transaksi</p>
                                </a> </li>
                            <li class="nav-item"> <a href="{{ route('pos/list') }}" class="nav-link"> <i
                                        class="nav-icon bi bi-cart-check-fill"></i>
                                    <p>POS</p>
                                </a> </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-header">AUTH</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i
                            class="nav-icon bi bi-door-closed-fill"></i>
                        <p>
                            Role
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('login') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-box-arrow-in-right"></i>
                                <p>Login</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('logout') }}" class="nav-link"> <i
                                    class="nav-icon bi bi-box-arrow-in-left"></i>
                                <p>Logout</p>
                            </a> </li>
                    </ul>
                </li>

                <li class="nav-item"> <a href="assets/examples/lockscreen.html" class="nav-link"> <i
                            class="nav-icon bi bi-circle"></i>
                        <p>Lockscreen</p>
                    </a> </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
