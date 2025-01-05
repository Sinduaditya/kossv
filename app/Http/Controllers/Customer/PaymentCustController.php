<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Stringable;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoices;

class PaymentCustController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
    }

    public function pay($id)
    {
        try {
            // Ambil data booking dan relasinya
            $booking = Booking::with('room')->findOrFail($id);

            // Buat instance Payment baru
            $payment = Payment::create([
                'id_pemesanan' => $booking->id, // Menggunakan ID Booking
                'metode_pembayaran' => 'Xendit', // Contoh metode pembayaran
                'tanggal_pemesanan' => now(),
                'jumlah_pembayaran' => $booking->room->harga,
            ]);

            // Parameter untuk invoice
            $createInvoice = new CreateInvoiceRequest([
                'external_id' => $booking->kode_booking, // Gunakan kode_booking
                'amount' => $payment->jumlah_pembayaran,
                'invoice_duration' => 172800, // 2 hari dalam detik
                'success_redirect_url' => route('booking.list'), // Redirect setelah sukses
                'failure_redirect_url' => route('booking.list'), // Redirect jika gagal
            ]);

            // Buat invoice di Xendit
            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);

            // Simpan link pembayaran ke database
            $payment->update(['link_pembayaran' => $generateInvoice['invoice_url']]);

            // Redirect ke halaman pembayaran Xendit
            return redirect()->away($payment->link_pembayaran);
        } catch (\Throwable $th) {
            // Handle error jika gagal membuat invoice Xendit
            return response()->json(
                [
                    'error' => 'Failed to create Xendit invoice: ' . $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function callback(Request $request)
    {
        // Ambil data callback
        $data = $request->all();
        $external_id = $data['external_id']; // Ini adalah kode_booking
        $status = $data['status'];
        // $status = strtolower($data['status']);
        $payment_method = $data['payment_method'];

        // Validasi callback token
        $xenditCallbackToken = 'bAO18ZZW65fhqZsPIWb8ovtfaZYEV93dLYPz21rjnbyibm6F';
        $receivedToken = $request->header('x-callback-token');
        if ($xenditCallbackToken !== $receivedToken) {
            Log::error('Invalid Callback Token!');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cari booking berdasarkan kode_booking
        $booking = Booking::where('kode_booking', $external_id)->first();

        if ($booking) {
            // Update status pembayaran di tabel booking
            $booking_status = $status === 'PAID' ? 'paid' : 'failed';
            $booking->update(['status_pembayaran' => $booking_status]);

            // Log untuk debug
            Log::info('Booking Status Updated: ' . $booking->kode_booking . ' to ' . $booking_status);

            return response()->json([
                'message' => 'Webhook processed successfully',
                'status' => $status,
                'payment_method' => $payment_method,
            ], 200);
        }

        return response()->json(['message' => 'Booking not found'], 404);
    }

}
