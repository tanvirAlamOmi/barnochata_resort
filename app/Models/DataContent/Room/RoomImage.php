<?php

namespace App\Models\DataContent\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = ['room_id','image','serial_no'];

    public function getImageAttribute($value)
    {
        if ($value){
            return asset("/img-contents/data-images/".$value);
        }
        return null;
    }
}
