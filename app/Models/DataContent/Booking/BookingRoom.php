<?php

namespace App\Models\DataContent\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Booking\Booking;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Package\Package;

class BookingRoom extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id','room_id','package_id','check_in_date','check_out_date','price','default_guest','extra_person_per_adult','extra_person_per_child','status'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
