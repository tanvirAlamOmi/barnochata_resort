<?php

namespace App\Models\DataContent\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Booking\BookingRoom;
use App\Models\DataContent\Booking\BookingAddons;
use App\Models\DataContent\Booking\Guest;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['booking_no','name','email','contact_no','total_adult','total_child','booking_date','check_in_date','check_out_date','booking_note','gross_total','status'];

    public function booking_rooms()
    {
        return $this->hasMany(BookingRoom::class)->with(['package','room']);
    }

    public function booking_rooms_only()
    {
        return $this->hasMany(BookingRoom::class, 'booking_id', 'id');
    }

    public function booking_addons()
    {
        return $this->hasMany(BookingAddons::class)->with('addons');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function getStatusAttribute($value)
    {
        if ($value){
            if($value == 1){
                return 'REQUESTED';
            }elseif($value == 2){
                return 'ACCEPTED';
            }elseif($value == 3){
                return 'ALTER';
            }elseif($value == 4){
                return 'CANCELLED';
            }elseif($value == 5){
                return 'ACTIVE';
            }elseif($value == 6){
                return 'COMPLETED';
            }
        }
        return null;
    }
}
