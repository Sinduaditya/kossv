<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with('customer', 'room')->get();
        return view('backend.booking.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('backend.booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status_pembayaran' => $request->status_pembayaran]);

        if ($request->status_pembayaran == 'failed') {
            $room = $booking->room;
            $room->update(['status_ketersediaan' => true]);
        }

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }

}
