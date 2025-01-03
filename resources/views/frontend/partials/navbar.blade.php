<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center p-2" href="#">
            <img src="{{ asset('frontend/images/logo-sv2.png') }}" alt="" class="me-2"
                style="width: 30px;">
            <h3 class="mb-0 text-uppercase">Kossv2</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.kamar') }}">Daftar Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.facility') }}">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.contact') }}">Kontak</a>
                </li>
                @auth('customer')
                @if(auth('customer')->user()->bookings()->count() > 0)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('booking.list') }}">
                        Daftar Booking</a>
                </li>
                @endif
                <li class="nav-item">
                    <form action="{{ route('logout_user') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login_user') }}">
                        <i class="fas fa-lock"></i>
                        Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
