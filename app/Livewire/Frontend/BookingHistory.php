<?php
namespace App\Livewire\Frontend;

use App\Models\Booking;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Exception;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\PaymentIntent;

class BookingHistory extends Component
{
    public $bookings;

    public function mount()
    {
        $this->checkPendingPayment();
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::where('user_id', Auth::id())
            ->with(['motorcycle', 'promocode', 'location'])
            ->orderBy('start_date', 'desc')
            ->get();
    }

    public function checkPendingPayment()
    {
        $pendingBookingId = session('pending_booking_id');
        if ($pendingBookingId) {
            $booking = Booking::where('id', $pendingBookingId)
                ->where('user_id', Auth::id())
                ->where('payment_status', 'pending')
                ->first();

            if ($booking && $booking->payment_session_id) {
                try {
                    Stripe::setApiKey(config('services.stripe.secret'));
                    $session = StripeSession::retrieve($booking->payment_session_id);

                    if ($session && $session->payment_status === 'paid') {
                        $booking->update([
                            'payment_status' => 'paid',
                            'status' => 'confirmed',
                        ]);
                        session()->flash('success', 'Payment successful. Booking confirmed.');
                        Mail::to(Auth::user()->email)->send(new BookingStatusUpdated($booking));
                    } elseif ($session->status === 'expired') {
                        $booking->update([
                            'payment_status' => 'failed',
                            'status' => 'cancelled',
                        ]);
                        session()->flash('error', 'Payment expired or cancelled.');
                        Mail::to(Auth::user()->email)->send(new BookingStatusUpdated($booking));
                    }
                    session()->forget('pending_booking_id');
                } catch (Exception $e) {
                    \Log::error('Stripe Session Check Error: ' . $e->getMessage(), ['booking_id' => $booking->id]);
                    session()->flash('error', 'Failed to verify payment: ' . $e->getMessage());
                    session()->forget('pending_booking_id');
                }
            } else {
                session()->forget('pending_booking_id');
            }
        }
    }

    public function cancelBooking($bookingId)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($bookingId);

        if ($booking->status === 'cancelled' || $booking->payment_status === 'paid') {
            session()->flash('error', 'This booking cannot be cancelled.');
            return;
        }

        $booking->update([
            'status' => 'cancelled',
            'payment_status' => 'failed',
        ]);

        // Send email notification
        Mail::to(Auth::user()->email)->send(new BookingStatusUpdated($booking));

        session()->flash('success', 'Booking cancelled successfully.');
        $this->loadBookings();
    }

    public function render()
    {
        return view('livewire.frontend.booking-history', ['bookings' => $this->bookings])
            ->layout('layouts.frontend');
    }
}
