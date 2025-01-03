@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Customer</h1>
    <!-- Form Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Customer</h6>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger position-fixed" style="top: 20px; right: 20px; z-index: 1050;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <div class="form-group">
                    <label for="no_telepon">No Telepon</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan no telepon" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="10" placeholder="Masukkan alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
