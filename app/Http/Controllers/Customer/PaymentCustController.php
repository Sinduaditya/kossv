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
            $order = new Payment;
            $order->id_pemesanan = $booking->id;
            $order->metode_pembayaran = 'Xendit'; // Contoh metode pembayaran
            $order->tanggal_pemesanan = now();
            $order->jumlah_pembayaran = $booking->room->harga;

            // Parameter untuk invoice
            $createInvoice = new CreateInvoiceRequest([
            'external_id' => (string) Str::uuid(),
            'amount' => $order->jumlah_pembayaran,
            'invoice_duration' => 172800, // 2 hari dalam detik
            ]);

            // Buat invoice di Xendit
            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);

            // Simpan link pembayaran ke database
            $order->link_pembayaran = $generateInvoice['invoice_url'];
            $order->save();

            // Redirect ke halaman pembayaran Xendit
            return redirect()->away($order->link_pembayaran);

        } catch (\Throwable $th) {
            // Handle error jika gagal membuat invoice Xendit
            return response()->json([
            'error' => 'Failed to create Xendit invoice: ' . $th->getMessage(),
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        // Ambil data callback
        $data = $request->all();
        $external_id = $data['external_id'];
        $status = strtolower($data['status']);
        $payment_method = $data['payment_method'];

        // Logging untuk debug
        Log::info('Xendit Callback: ', $data);

        // Cari payment berdasarkan external_id
        $order = Payment::where('external_id', $external_id)->first();

        if ($order) {
            // Update status pembayaran pada tabel payments
            $order->status = $status;
            $order->payment_method = $payment_method;
            $order->save();

            // Update status pembayaran booking menjadi 'paid' atau 'failed'
            $booking = $order->booking;
            if ($booking) {
            $booking_status = $status === 'paid' ? 'paid' : 'failed';
            $booking->update(['status_pembayaran' => $booking_status]);
            Log::info('Booking Status Updated: ' . $booking->id . ' to ' . $booking_status);
            }

            return response()->json([
            'message' => 'Webhook received',
            'status' => $status,
            'payment_method' => $payment_method,
            ], 200);
        }

        return response()->json(['message' => 'Payment not found'], 404);
    }

}
