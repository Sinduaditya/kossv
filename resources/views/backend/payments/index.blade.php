@extends('layouts.admin')
@prepend('styles')
    <link href="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endprepend
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Payments</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment Management</h6>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="position: fixed; top: 100px; right: 20px; z-index: 1050;">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    onclick="this.parentElement.style.display='none';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="position: fixed; top: 100px; right: 20px; z-index: 1050;">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    onclick="this.parentElement.style.display='none';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Payment Method</th>
                            <th>Booking Date</th>
                            <th>Payment Amount</th>
                            <th>Payment Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->booking->kode_booking }}</td>
                                <td>{{ $payment->metode_pembayaran }}</td>
                                <td>{{ $payment->tanggal_pemesanan }}</td>
                                <td>{{ $payment->jumlah_pembayaran }}</td>
                                <td><a href="{{ $payment->link_pembayaran }}" target="_blank">Payment Link</a></td>
                                <td>
                                    <form action="{{ route('payment.destroy', $payment->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@prepend('scripts')
    <script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endprepend
