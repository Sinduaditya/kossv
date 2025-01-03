@extends('layouts.admin')
@prepend('styles')
    <link href="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endprepend
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kamar</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Managemen Data Kamar</h6>
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
            <a href="{{ route('room.create') }}" class="btn btn-primary mb-3">Tambah Kamar</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tipe Kamar</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Status Ketersediaan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $rooms as $room )
                        <tr>
                            <th>{{ $room->tipe_kamar }}</th>
                            <th><img src="/images/{{ $room->gambar }}" alt="{{ $room->tipe_kamar }}" width="80"></th>
                            <th>Rp. {{ number_format($room->harga, 0, ',', '.') }}</th>
                            <th>
                                @if($room->status_ketersediaan)
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                @endif
                            </th>
                            <th>{{ $room->deskripsi }}</th>
                            <th>{{ $room->date_added }}</th>
                            <th class="d-flex justify-content-center">
                                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('room.destroy', $room->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </th>
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

