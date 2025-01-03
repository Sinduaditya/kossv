@extends('layouts.admin')
@prepend('styles')
    <link href="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endprepend
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pelanggan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Management Pelanggan</h6>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 100px; right: 20px; z-index: 1050;">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 100px; right: 20px; z-index: 1050;">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card-body">
            <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $customers as $customer )
                        <tr>
                            <td>{{ $customer->nama }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->no_telepon }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->created_at }}</td>
                            <td>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="d-inline">
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
