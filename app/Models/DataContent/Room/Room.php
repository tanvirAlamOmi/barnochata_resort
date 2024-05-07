<?php

namespace App\Models\DataContent\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\DataImage;
use App\Models\DataContent\Package\PackageRoom;
use App\Models\DataContent\Room\RoomPackage;
use App\Models\DataContent\Room\RoomImage;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['category','title','slug','description','default_image','guest_capacity','max_guest_capacity','price','extra_person_per_adult','extra_person_per_child','serial_no','status'];

    protected $appends = array('price_currency');

    public function images()
    {
        return $this->hasMany(DataImage::class, 'id','model_id')->where('model','room')->orderBy('serial_no','ASC');
    }

    public function getDefaultImageAttribute($value)
    {
        if ($value){
            return asset("/img-contents/data-images/".$value);
        }
        return null;
    }

    public function getPriceCurrencyAttribute()
    {
        return $this->attributes['price'].' '.config('app.base_currency');
    }

    public function package_rooms()
    {
        return $this->hasMany(PackageRoom::class);
    }

    public function room_packages()
    {
        return $this->hasMany(RoomPackage::class)->select('id','room_id','package_id','default_guest','price','extra_person_per_adult','extra_person_per_child');
    }

    public function room_images()
    {
        return $this->hasMany(RoomImage::class)->select('id','room_id','image','serial_no');
    }
}
