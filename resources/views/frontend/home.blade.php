@extends('layouts.app2')
@section('content')
    <div class="featured section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-image">
                        <img src="{{ asset('frontend/images/kosdepan.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="section-heading">
                        @if (auth('customer')->check())
                            <p>Selamat datang, {{ auth('customer')->user()->nama }}</p>
                        @else
                            <p>Selamat datang, Pengunjung</p>
                        @endif

                        <h6>| Kos Sv2</h6>
                        <h2>Kos Paling Strategis <br> di Semarang</h2>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Mengapa Kos Sv2 terbaik untuk Anda?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Dapatkan pengalaman <strong>pemesanan kos</strong> yang cepat, mudah, dan aman di
                                    Kos Sv2. Aplikasi kami dirancang dengan teknologi terkini untuk memberikan informasi
                                    real-time tentang ketersediaan kamar kos, harga terbaik, dan metode pembayaran yang
                                    praktis.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Bagaimana cara menggunakan aplikasi ini?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Sangat mudah! Daftar sebagai pengguna, lihat detail lengkap seperti fasilitas dan
                                    harga, lalu lakukan pemesanan langsung melalui aplikasi. Nikmati metode pembayaran
                                    yang aman dengan integrasi <code>Xendit</code>. Segera coba dan rasakan
                                    perbedaannya!
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Mengapa kos ini pilihan terbaik?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Kos ini adalah pilihan terbaik karena lokasinya yang paling strategis di kota
                                    Semarang, serta menawarkan keamanan dan kenyamanan terbaik. Dengan fasilitas lengkap
                                    dan lingkungan yang aman, Anda akan merasa nyaman dan tenang selama tinggal di sini.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="info-table">
                        <ul>
                            <li>
                                <h4>120 m2<br><span>Total Luas Bangunan</span></h4>
                            </li>
                            <li>
                                <h4>3 Lantai<br><span>Lantai ketiga adalah rooftop untuk jemur pakaian</span></h4>
                            </li>
                            <li>
                                <h4>Terjangkau<br><span>Mulai Dari 1 juta-an</span></h4>
                            </li>
                            <li>
                                <h4>Aman<br><span>CCTV 24/7</span></h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fun-facts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="counter">
                                    <h2 class="">
                                        <i class="fas fa-location-arrow"></i>
                                    </h2>
                                    <p class="count-text">Paling Strategis</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="counter">
                                    <h2 class="">
                                        <i class="fa fa-chair"></i>
                                    </h2>
                                    <p class="count-text">Paling Nyaman</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="counter">
                                    <h2 class="">
                                        <i class="fa fa-lock"></i>
                                    </h2>
                                    <p class="count-text">Paling Aman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
