@extends('layouts.app2')

@section('content')
    <div class="container mt-5  pb-5">
        <h2 class="text-center mb-4">Daftar Booking</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <p>Welcome, {{ Auth::user() ? auth('customer')->user()->nama : 'Guest' }}</p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Booking Kamar</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Room</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->kode_booking }}</td>
                                <td>{{ $booking->room->tipe_kamar }}</td>
                                <td>Rp {{ number_format($booking->room->harga, 0, ',', '.') }}</td>
                                <td>{{ $booking->status_pembayaran }}</td>
                                <td>Rp {{ number_format($booking->room->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5 class="card-title">Payment Information</h5>
                <p class="alert alert-info">
                    Harap menghubungi admin bila ingin melakukan survey. <br> Apabila dalam <span
                        class="text-danger">1x24</span> jam tidak konfirmasi terkait survey dan pembayaran maka akan di
                    <b>cancel</b>.
                    <br>
                    Nomor Admin : <a href="https://wa.me/62895359203353" target="_blank">0895359203353</a>
                </p>
                <div class="d-flex flex-row align-items-center gap-2">
                @if ($booking->status_pembayaran == 'pending')
                    <form action="{{ route('payment.pay', $booking->id) }}" method="GET" class="w-100">
                        <button type="submit" class="btn btn-primary w-100">Pay Now</button>
                    </form>
                    <form action="{{ route('bookingCust.destroy', $booking->id) }}" method="POST" class="w-100" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">Batalkan</button>
                    </form>
                @elseif ($booking->status_pembayaran == 'failed')
                    <a href="{{ route('home') }}" class="btn btn-primary w-100">Kembali ke Home</a>
                @elseif ($booking->status_pembayaran == 'paid')
                    <button type="submit" class="btn btn-success w-100" disabled>Berhasil Dibayar</button>
                    <a href="{{ route('home') }}" class="btn btn-primary w-100">Kembali ke Home</a>
                @endif
                </div>
            </div>
        </div>
        @if ($bookings->isEmpty())
            <div class="alert alert-warning" role="alert">
                No bookings found.
            </div>
        @endif
    </div>
@endsection
