<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KOS <sup>SV2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Kamar -->
    <li class="nav-item {{ request()->routeIs('room*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('room.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Kamar</span></a>
    </li>

    <!-- Nav Item - Pelanggan -->
    <li class="nav-item {{ request()->routeIs('customer*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span></a>
    </li>

    <!-- Nav Item - Pemesanan -->
    <li class="nav-item {{ request()->routeIs('booking*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('booking.index') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Pemesanan</span></a>
    </li>

    <!-- Nav Item - Pembayaran -->
    <li class="nav-item {{ request()->routeIs('payment*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('payment.index') }}">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <form action="{{ route('logout_admin') }}" method="POST">
            @csrf
            <button class="nav-link btn btn-link">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-globe"></i>
            <span>Ke Aplikasi </span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
