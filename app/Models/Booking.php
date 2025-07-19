<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motorcycle_id',
        'promocode_id',
        'location_id',
        'start_date',
        'end_date',
        'total_cost',
        'status',
        'payment_status',
         'invoice_id',           // Tambahkan ini
    'xendit_invoice_id',    // Tambahkan ini
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'string',
        'payment_status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function promocode()
    {
        return $this->belongsTo(Promocode::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}