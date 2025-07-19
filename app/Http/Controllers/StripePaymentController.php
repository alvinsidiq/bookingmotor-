<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripePaymentController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret'); // lebih baik dari env() langsung

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (SignatureVerificationException $e) {
            Log::error('[Stripe Webhook] Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        } catch (\UnexpectedValueException $e) {
            Log::error('[Stripe Webhook] Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Exception $e) {
            Log::error('[Stripe Webhook] General error: ' . $e->getMessage());
            return response('Webhook error', 500);
        }

        Log::info('[Stripe Webhook] Event received: ' . $event->type);

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $booking = Booking::where('payment_session_id', $session->id)->first();
            if ($booking && $booking->payment_status !== 'paid') {
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                try {
                    Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));
                } catch (\Exception $e) {
                    Log::error('[Stripe Webhook] Email sending failed: ' . $e->getMessage());
                }

                Log::info('[Stripe Webhook] Booking updated: ' . $booking->id);
            } else {
                Log::warning('[Stripe Webhook] Booking not found or already paid: session_id=' . $session->id);
            }
        }

        return response('Webhook received', 200);
    }
}
