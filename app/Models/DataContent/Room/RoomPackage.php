<?php

namespace App\Models\DataContent\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Room\Room;

class RoomPackage extends Model
{
    use HasFactory;

    protected $table = 'package_rooms';

    protected $fillable = ['package_id','room_id','default_guest','price','extra_person_per_adult','extra_person_per_child'];

    public function package()
    {
        return $this->belongsTo(Package::class)->select('id','title','slug','type','duration','description','start_date','end_date');
    }

    public function room()
    {
        return $this->belongsTo(Room::class)->select('id','title','slug','price','default_image');
    }
}
