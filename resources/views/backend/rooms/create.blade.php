@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Kamar</h1>
    <!-- Form Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kamar</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="room_type">Tipe Kamar</label>
                    <input type="text" class="form-control" id="room_type" name="tipe_kamar" placeholder="Masukkan tipe kamar" required>
                </div>
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control-file" id="image" name="gambar" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="price" name="harga" placeholder="Masukkan harga kamar" required>
                </div>
                <div class="form-group">
                    <label for="availability">Status Ketersediaan</label>
                    <select class="form-control" id="availability" name="status_ketersediaan" required>
                        <option value="1">Tersedia</option>
                        <option value="0">Tidak Tersedia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="deskripsi" rows="8" placeholder="Masukkan deskripsi kamar" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date_added">Tanggal Ditambahkan</label>
                    <input type="date" class="form-control" id="date_added" name="date_added" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
