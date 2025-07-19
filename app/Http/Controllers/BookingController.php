<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Motorcycle;
use App\Models\Location;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdated;
use Xendit\Xendit;
use Xendit\Invoice;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'motorcycle', 'promocode', 'location'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $motorcycles = Motorcycle::where('is_available', true)->where('rental_rate', '>', 0)->get();
        $promocodes = Promocode::where('is_active', true)->where('valid_until', '>=', now())->get();
        $locations = Location::where('is_active', true)->get();

        return view('admin.bookings.create', compact('users', 'motorcycles', 'promocodes', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'motorcycle_id' => 'required|exists:motorcycles,id',
            'location_id' => 'required|exists:locations,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'promocode_id' => 'nullable|exists:promocodes,id',
        ]);

        $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;
        $motorcycle = Motorcycle::findOrFail($request->motorcycle_id);

        if ($motorcycle->rental_rate <= 0) {
            return back()->with('error', 'Harga sewa motor tidak valid.');
        }

        $baseCost = $motorcycle->rental_rate * $days;
        $discount = 0;

        if ($request->promocode_id) {
            $promocode = Promocode::find($request->promocode_id);
            if ($promocode && $promocode->is_active && $promocode->valid_until >= now()) {
                $maxDiscount = 99;
                $discountRate = min($promocode->discount_percentage, $maxDiscount);
                $discount = $baseCost * ($discountRate / 100);
            }
        }

        $totalCost = max($baseCost - $discount, 0);

        if ($totalCost <= 0) {
            return back()->with('error', 'Total cost must be greater than 0. Periksa harga sewa dan promo.');
        }

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'motorcycle_id' => $request->motorcycle_id,
            'location_id' => $request->location_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'pending',
            'payment_status' => 'pending',
            'promocode_id' => $request->promocode_id,
        ]);

        // Setup Xendit
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

        try {
            $invoice = Invoice::create([
                'external_id' => 'booking-' . $booking->id,
                'amount' => (int) $booking->total_cost,
                'payer_email' => $booking->user->email,
                'description' => 'Booking for ' . $booking->motorcycle->name,
            ]);

            // (Optional) Save invoice URL or ID if needed
            $booking->update(['payment_status' => 'pending']);

            Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));

            return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat invoice: ' . $e->getMessage());
        }
    }

    public function edit(Booking $booking)
    {
        $users = User::where('role', 'user')->get();
        $motorcycles = Motorcycle::where('is_available', true)->get();
        $promocodes = Promocode::where('is_active', true)->where('valid_until', '>=', now())->get();
        $locations = Location::where('is_active', true)->get();

        return view('admin.bookings.edit', compact('booking', 'users', 'motorcycles', 'promocodes', 'locations'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'motorcycle_id' => 'required|exists:motorcycles,id',
            'promocode_id' => 'nullable|exists:promocodes,id',
            'location_id' => 'required|exists:locations,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,confirmed,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;
        $motorcycle = Motorcycle::findOrFail($request->motorcycle_id);
        $totalCost = $motorcycle->rental_rate * $days;

        // Hitung ulang diskon jika promo digunakan
        if ($request->promocode_id) {
            $promocode = Promocode::findOrFail($request->promocode_id);
            if ($promocode->is_active && $promocode->valid_until >= now() && $promocode->used_count < $promocode->max_usage) {
                if ($promocode->discount_type === 'percentage') {
                    $totalCost -= ($totalCost * $promocode->discount_value / 100);
                } else {
                    $totalCost -= $promocode->discount_value;
                }
            }
        }

        // Update booking
        $booking->update(array_merge($validated, [
            'total_cost' => max($totalCost, 0),
        ]));

        // Kirim notifikasi
        Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
