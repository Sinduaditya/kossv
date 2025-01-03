@extends('layouts.app2')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Reserve Room: {{ $room->tipe_kamar }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookingCust.store', $room->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" name="tanggal_pemesanan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                            <input type="date" name="tanggal_berakhir" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
