<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

            // Generate nomor transaksi unik
            $no_transaction = 'Inv-' . rand();

            // Parameter untuk invoice
            $params = new CreateInvoiceRequest([
                'external_id' => $no_transaction,
                'amount' => $booking->room->harga,
                'payer_email' => Auth::guard('customer')->user()->email,
                'description' => 'Payment for Booking ' . $booking->kode_booking,
                'invoice_duration' => 172800, // 2 hari dalam detik
                'items' => [
                    [
                        'name' => 'Room Booking - ' . $booking->room->tipe_kamar,
                        'price' => $booking->room->harga,
                        'quantity' => 1,
                    ],
                ],
            ]);

            // Buat invoice di Xendit
            $apiInstance = new InvoiceApi();
            $invoice = $apiInstance->createInvoice($params);

            // Simpan data pembayaran ke database
            $payment = Payment::create([
                'id_pemesanan' => $booking->id,
                'metode_pembayaran' => 'Xendit',
                'tanggal_pemesanan' => now(),
                'jumlah_pembayaran' => $booking->room->harga,
                'link_pembayaran' => $invoice->getInvoiceUrl(),
                'status_pembayaran' => 'pending', // Status awal pembayaran adalah pending
            ]);

            // Redirect ke halaman pembayaran Xendit
            return redirect($invoice->getInvoiceUrl());

            // Log link invoice
            // Log::info('Invoice created: ' . $invoice->getInvoiceUrl());
        } catch (\Throwable $th) {
            // Handle error jika gagal membuat invoice Xendit
            return redirect()
                ->back()
                ->with('error', 'Failed to create Xendit invoice: ' . $th->getMessage());
        }
    }

    public function callback(Request $request)
    {
        // Ambil data pembayaran dari invoice URL
        $payment = Payment::where('link_pembayaran', $request->invoice_url)->first();

        if ($payment && $request->status === 'PAID') {
            // Update status pembayaran
            $payment->update(['status_pembayaran' => 'paid']);

            // Update status pembayaran booking
            $payment->booking->update(['status_pembayaran' => 'paid']);
        }

        return response()->json(['message' => 'Callback processed successfully.']);
    }
}
