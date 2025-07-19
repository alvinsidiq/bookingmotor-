<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Booking;
use App\Mail\BookingStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Xendit\Xendit;
use Exception;
use App\Http\Controllers\Controller;

class PaymentCallbackController extends Controller
{
    public function handleSuccess(Request $request, $booking_id)
    {
        \Log::info('Payment callback triggered', ['booking_id' => $booking_id, 'session_pending_booking_id' => session('pending_booking_id')]);

        // Verifikasi booking_id
        $booking = Booking::where('id', $booking_id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$booking) {
            \Log::error('Booking not found', ['booking_id' => $booking_id]);
            session()->flash('error', 'Booking not found.');
            return redirect()->route('frontend.bookings');
        }

        // Verifikasi bahwa booking_id sesuai dengan sesi
        $pendingBookingId = session('pending_booking_id');
        if ($pendingBookingId != $booking_id) {
            \Log::error('Invalid booking ID in session', ['booking_id' => $booking_id, 'pending_booking_id' => $pendingBookingId]);
            session()->flash('error', 'Invalid booking ID.');
            return redirect()->route('frontend.bookings');
        }

        // Verifikasi status pembayaran di Xendit
        try {
            Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
            $invoice = \Xendit\Invoice::retrieve('booking-' . $booking_id);

            \Log::info('Xendit invoice retrieved', [
                'booking_id' => $booking_id,
                'invoice_id' => $invoice['id'],
                'status' => $invoice['status'],
                'external_id' => $invoice['external_id'],
            ]);

            if ($invoice['status'] === 'PAID') {
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                // Kirim notifikasi email
                Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));

                // Hapus booking_id dari sesi
                session()->forget('pending_booking_id');

                session()->flash('success', 'Payment successful. Booking confirmed.');
            } else {
                \Log::warning('Payment not completed', ['booking_id' => $booking_id, 'invoice_status' => $invoice['status']]);
                session()->flash('error', 'Payment not completed. Status: ' . $invoice['status']);
            }
        } catch (Exception $e) {
            \Log::error('Xendit Invoice Retrieve Error: ' . $e->getMessage(), ['booking_id' => $booking_id]);
            session()->flash('error', 'Failed to verify payment: ' . $e->getMessage());
        }

        return redirect()->route('frontend.bookings');
    }

    public function handleFailure(Request $request)
    {
        $booking_id = session('pending_booking_id');
        \Log::info('Payment failure callback triggered', ['booking_id' => $booking_id]);

        if ($booking_id) {
            $booking = Booking::where('id', $booking_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($booking) {
                $booking->update([
                    'payment_status' => 'failed',
                    'status' => 'cancelled',
                ]);

                // Kirim notifikasi email
                Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));
            } else {
                \Log::error('Booking not found in failure callback', ['booking_id' => $booking_id]);
            }

            // Hapus booking_id dari sesi
            session()->forget('pending_booking_id');
        }

        session()->flash('error', 'Payment failed or cancelled.');
        return redirect()->route('frontend.bookings');
    }
}