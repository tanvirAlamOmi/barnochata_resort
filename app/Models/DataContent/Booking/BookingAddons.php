<?php

namespace App\Models\DataContent\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Addons;

class BookingAddons extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id','addons_id','addons_counter'];

    public function addons()
    {
        return $this->belongsTo(Addons::class);
    }
}
