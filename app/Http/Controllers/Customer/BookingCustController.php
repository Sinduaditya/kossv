<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingCustController extends Controller
{
    // Tampilkan halaman reservasi kamar
    public function reserve($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.reserve', compact('room'));
    }

    // Simpan data booking
    public function store(Request $request, $id)
    {
        $userId = Auth::guard('customer')->id();

        $existingBooking = Booking::where('user_id', $userId)
            ->whereIn('status_pembayaran', ['pending', 'failed'])
            ->first();

        if ($existingBooking) {
            return redirect()->route('booking.list')->with('error', 'Anda hanya dapat memiliki satu booking aktif. Harap selesaikan pembayaran atau batalkan booking sebelumnya.');
        }

        $room = Room::findOrFail($id);

        Booking::create([
            'user_id' => $userId,
            'id_kamar' => $room->id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'status_pembayaran' => 'pending',
            'kode_booking' => uniqid('BOOK-'),
        ]);

        $room->update(['status_ketersediaan' => false]);
        return redirect()->route('booking.list')->with('success', 'Booking berhasil dibuat.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $room = Room::findOrFail($booking->id_kamar);

        $booking->delete();
        $room->update(['status_ketersediaan' => true]);

        return redirect()->route('home.kamar')->with('success', 'Booking berhasil dicancel.');
    }

    public function list()
    {
        // Ambil user ID dari guard 'customer'
        $userId = Auth::guard('customer')->id();

        // Query data booking milik user yang sedang login
        $bookings = Booking::with('room')->where('user_id', $userId)->get();

        // Jika tidak ada data booking
        if ($bookings->isEmpty()) {
            return redirect()->route('home')->with('error', 'No bookings found.');
        }

        return view('frontend.list', compact('bookings', 'userId'));
    }
}
