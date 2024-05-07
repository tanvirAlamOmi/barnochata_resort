<?php

namespace App\Models\DataContent\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Package\PackageRoom;
use App\Models\DataContent\Package\PackageAddons;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','type','duration','description','start_date','end_date','price','serial_no','status'];

    public function package_rooms()
    {
        return $this->hasMany(PackageRoom::class)->select('id','package_id','room_id','default_guest','price','extra_person_per_adult','extra_person_per_child');
    }

    public function package_addons()
    {
        return $this->hasMany(PackageAddons::class)->select('id','package_id','addons_id','counter');
    }
}
