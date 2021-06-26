<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">InventoryApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
        {{--    <div class="info">--}}
        {{--        <a href="#" class="d-block">Welcome, {{ auth()->user()->name }}.</a>--}}
        {{--    </div>--}}
        {{--</div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                @can('viewAny', \App\Models\User::class)
                <li class="nav-item">
                    <a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employees
                        </p>
                    </a>
                </li>
                @endcan

                @can('manage', \App\Models\Equipment::class)
                <li class="nav-item">
                    <a href="/equipment" class="nav-link {{ request()->is('equipment', 'equipment/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>
                            Equipment
                        </p>
                    </a>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="/tickets" class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Tickets
                        </p>
                    </a>
                </li>

                @can('viewAny', \App\Models\PurchaseOrder::class)
                <li class="nav-item">
                    <a href="/purchase-orders" class="nav-link {{ request()->is('purchase-orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            Purchase Orders
                        </p>
                    </a>
                </li>
                @endcan

                @can('manage', \App\Models\EquipmentCategory::class)
                <li class="nav-item">
                    <a href="{{ route('equipment-categories.index') }}" class="nav-link {{ request()->is('equipment-categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Equipment Categories
                        </p>
                    </a>
                </li>
                @endcan

                @can('manage', \App\Models\Department::class)
                    <li class="nav-item">
                        <a href="{{ route('departments.index') }}" class="nav-link {{ request()->is('departments*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Departments
                            </p>
                        </a>
                    </li>
                @endcan

                @can('manage', \App\Models\Position::class)
                    <li class="nav-item">
                        <a href="{{ route('positions.index') }}" class="nav-link {{ request()->is('positions*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Positions
                            </p>
                        </a>
                    </li>
                @endcan

                @can('manage', \App\Models\Role::class)
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
