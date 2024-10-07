<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        <img src="{{ asset('img/icon.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (empty(Auth::user()->profile_photo_path))
                    <img src="{{ asset('img/no_photo.svg') }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('storage/photo_user/' . Auth::user()->profile_photo_path) }}"
                        class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            @php
                $PermissionUser = App\Models\PermissionRole::getPermission('User', Auth::user()->role_id);
                $PermissionRole = App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id);
                $PermissionTransaksi = App\Models\PermissionRole::getPermission('Transaksi', Auth::user()->role_id);
                $PermissionAddTransaksi = App\Models\PermissionRole::getPermission(
                    'Add Transaksi',
                    Auth::user()->role_id,
                );
                $PermissionProduct = App\Models\PermissionRole::getPermission('Product', Auth::user()->role_id);
                $PermissionSupplier = App\Models\PermissionRole::getPermission('Supplier', Auth::user()->role_id);
                $PermissionReporting = App\Models\PermissionRole::getPermission('Reporting', Auth::user()->role_id);
            @endphp
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">General</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (!empty($PermissionProduct) || !empty($PermissionSupplier))
                    <li class="nav-item">
                        <a href="#" class="nav-link @if (Request::segment(2) == 'product' || Request::segment(2) == 'supplier') active @endif">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ">

                            @if (!empty($PermissionProduct))
                                <li class="nav-item">
                                    <a href="{{ route('product.index') }}"
                                        class="nav-link @if (Request::segment(2) == 'product') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Product</p>
                                    </a>
                                </li>
                            @endif

                            @if (!empty($PermissionSupplier))
                                <li class="nav-item">
                                    <a href="{{ route('supplier.index') }}"
                                        class="nav-link @if (Request::segment(2) == 'supplier') active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Supplier</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (!empty($PermissionReporting))
                    <li class="nav-item">
                        <a href="{{ route('reporting') }}"
                            class="nav-link @if (Request::segment(2) == 'reporting') active @endif">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Reporting
                            </p>
                        </a>
                    </li>
                @endif

                @if (!empty($PermissionTransaksi) || !empty($PermissionAddTransaksi))
                    <li class="nav-header">Transaksi</li>
                @endif

                <li class="nav-item">

                    @if (!empty($PermissionAddTransaksi))
                        <a href="{{ route('create-transaksi') }}"
                            class="nav-link @if (Request::segment(2) == 'create-transaksi') active @endif">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Buat Transaksi
                            </p>
                        </a>
                </li>
                @endif

                @if (!empty($PermissionTransaksi))
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}"
                            class="nav-link @if (Request::segment(2) == 'transaksi') active @endif">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                @endif

                @if (!empty($PermissionUser) || !empty($PermissionRole))
                    <li class="nav-header">Management</li>
                @endif

                @if (!empty($PermissionUser))
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link @if (Request::segment(2) == 'user') active @endif">
                            <i class="fas fa-users nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif

                @if (!empty($PermissionRole))
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}"
                            class="nav-link @if (Request::segment(2) == 'role') active @endif">
                            <i class="fas fa-users-cog nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item mt-4">
                    <a href="{{ route('logout') }}" class="nav-link bg-danger">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
