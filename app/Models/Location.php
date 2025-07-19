<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'is_active',
        'operating_hours',
        'contact_phone',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'operating_hours' => 'array',
    ];

    public function pickupBookings()
    {
        return $this->hasMany(Booking::class, 'pickup_location_id');
    }

    public function dropoffBookings()
    {
        return $this->hasMany(Booking::class, 'dropoff_location_id');
    }
}