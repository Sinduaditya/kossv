@extends('layouts.app2')
@section('content')
    <div id="daftarkamar" class="properties section">
        <div class="container">

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Daftar Kamar</h6>
                        <h2>Kami Menyediakan Kamar Terbaik Untuk Anda</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($rooms as $room)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="/images/{{ $room->gambar }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->tipe_kamar }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Rp {{ number_format($room->harga, 0, ',', '.') }} / bulan</h6>
                                <p class="card-text">Deskripsi: {{ $room->deskripsi }}</p>
                                <p class="card-text">Status:
                                    @if (isset($room->status_ketersediaan) && $room->status_ketersediaan)
                                        <span class="badge bg-success text-white">Tersedia</span>
                                    @else
                                        <span class="badge bg-danger text-white">Tidak Tersedia</span>
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                @auth('customer')
                                    @if (isset($room->status_ketersediaan) && $room->status_ketersediaan)
                                        <a href="{{ route('booking.reserve', $room->id) }}" class="btn btn-primary">Reserve</a>
                                    @else
                                        <a href="javascript:void(0);" class="btn btn-secondary disabled">Be Reserved</a>
                                    @endif
                                @else
                                    <span>Harap Login / Register Terlebih dahulu !</span>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 text-center">
                        <span>Belum ada kamar yang tersedia</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
