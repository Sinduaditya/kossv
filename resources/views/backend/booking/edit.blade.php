@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Status Pemesanan</h1>
    <!-- Form Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Status Pemesanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('booking.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran</label>
                    <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                        <option value="pending" {{ $booking->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $booking->status_pembayaran == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $booking->status_pembayaran == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
