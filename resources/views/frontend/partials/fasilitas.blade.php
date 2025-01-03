@extends('layouts.app2')
@section('content')
<div class="best-deal">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6>| Fasilitas</h6>
                    <h2>Fasilitas Terbaik Untuk Anda</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tabs-content">
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="appartment" role="tabpanel"
                                aria-labelledby="appartment-tab">
                                <div class="row">
                                    <div class="col-lg-3 mb-3">
                                        <h4>Fasilitas Lainnya</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item">AC & TV</li>
                                            <li class="list-group-item">Lemari</li>
                                            <li class="list-group-item">Free Wi-Fi</li>
                                            <li class="list-group-item">CCTV 24 Jam</li>
                                            <li class="list-group-item">Meja & Kursi</li>
                                            <li class="list-group-item">Kamar Mandi Dalam</li>
                                            <li class="list-group-item">Spring Bed</li>
                                            <li class="list-group-item">Dapur</li>
                                            <li class="list-group-item">Rooftop Kossv123</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{ asset('frontend/images/kosdepan.jpg') }}" alt="">
                                    </div>
                                    <div class="col-lg-3">
                                        <h4>Informasi Tambahan</h4>
                                        <p>Kos Sv2 menawarkan berbagai fasilitas untuk kenyamanan Anda. Lokasi
                                            strategis dan lingkungan yang aman membuat kos ini menjadi pilihan
                                            terbaik di Semarang.</p>

                                        <div class="icon-button">
                                            <a href="{{ route('home.kamar') }}"><i class="fa fa-home"></i> Lihat
                                                Kamar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
