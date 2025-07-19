<?php

namespace App\Livewire\Frontend;

use App\Models\Motorcycle;
use App\Models\Location;
use App\Models\Promocode;
use App\Models\Booking;
use Livewire\Component;
use Carbon\Carbon;
use Exception;
use Xendit\Xendit;

class MotorcycleDetail extends Component
{
    public $slug;
    public $motorcycle;
    public $location_id = '';
    public $promocode_id = '';
    public $start_date = '';
    public $end_date = '';
    public $total_cost = 0;

    protected $rules = [
        'location_id' => 'required|exists:locations,id',
        'promocode_id' => 'nullable|exists:promocodes,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->motorcycle = Motorcycle::with(['category', 'brand'])->where('slug', $slug)->firstOrFail();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->calculateTotalCost();
    }

    public function calculateTotalCost()
    {
        if ($this->start_date && $this->end_date) {
            $days = Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
            $total = $this->motorcycle->rental_rate * max(1, $days); // min 1 day

            if ($this->promocode_id) {
                $promocode = Promocode::find($this->promocode_id);
                if ($promocode && $promocode->is_active && $promocode->valid_until >= now() && $promocode->used_count < $promocode->max_usage) {
                    if ($promocode->discount_type === 'percentage') {
                        $total -= ($total * $promocode->discount_value / 100);
                    } else {
                        $total -= $promocode->discount_value;
                    }
                }
            }

            $this->total_cost = max(0, $total);
        } else {
            $this->total_cost = 0;
        }
    }

    public function book()
    {
        $this->validate();

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        try {
            // Buat Booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'motorcycle_id' => $this->motorcycle->id,
                'promocode_id' => $this->promocode_id ?: null,
                'location_id' => $this->location_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_cost' => $this->total_cost,
                'status' => 'pending',
                'payment_status' => 'pending',
            ]);

            if ($this->promocode_id) {
                Promocode::find($this->promocode_id)?->increment('used_count');
            }

            // Buat Invoice ke Xendit
            Xendit::setApiKey(env('XENDIT_SECRET_KEY'));

            $invoice = \Xendit\Invoice::create([
                'external_id' => 'booking-' . $booking->id . '-' . time(),
                'payer_email' => auth()->user()->email,
                'description' => 'Sewa motor: ' . $this->motorcycle->name,
                'amount' => $this->total_cost,
                'success_redirect_url' => route('home'),
                'failure_redirect_url' => route('home'),
            ]);

            $booking->update([
                'invoice_id' => $invoice['id'],
                'xendit_invoice_id' => $invoice['id'], // opsional jika kamu pisahkan
            ]);

            return redirect()->to($invoice['invoice_url']);
        } catch (Exception $e) {
            \Log::error('Gagal membuat invoice Xendit: ' . $e->getMessage());
            return redirect()->route('frontend.motorcycles.show', $this->slug)
                ->with('error', 'Terjadi kesalahan saat membuat invoice. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.motorcycle-detail', [
            'motorcycle' => $this->motorcycle,
            'locations' => Location::where('is_active', true)->get(),
            'promocodes' => Promocode::where('is_active', true)
                ->where('valid_until', '>=', now())
                ->get(),
            'total_cost' => $this->total_cost,
        ])->layout('layouts.frontend');
    }
}
