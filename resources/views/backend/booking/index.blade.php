@extends('layouts.admin')
@prepend('styles')
    <link href="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endprepend
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Management Pemesanan</h6>
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
                            <th>Customer Name</th>
                            <th>Room</th>
                            <th>Booking Date</th>
                            <th>End Date</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->kode_booking }}</td>
                                <td>{{ $booking->customer->nama }}</td>
                                <td>{{ $booking->room->tipe_kamar }}</td>
                                <td>{{ $booking->tanggal_pemesanan }}</td>
                                <td>{{ $booking->tanggal_berakhir }}</td>
                                <td>{{ $booking->status_pembayaran }}</td>
                                <td>
                                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

      <!-- Edit Modal -->
      {{-- <div class="modal fade" id="editModal{{ $booking->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $booking->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $booking->id }}">Edit Payment
                        Status</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('booking.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status_pembayaran">Payment Status</label>
                            <select class="form-control" id="status_pembayaran"
                                name="status_pembayaran">
                                <option value="Paid"
                                    {{ $booking->status_pembayaran == 'Paid' ? 'selected' : '' }}>
                                    Paid</option>
                                <option value="Pending"
                                    {{ $booking->status_pembayaran == 'Pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="Cancelled"
                                    {{ $booking->status_pembayaran == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@prepend('scripts')
    <script src="{{ asset('/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/js/demo/datatables-demo.js') }}"></script>
@endprepend
