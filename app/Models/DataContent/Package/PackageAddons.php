<?php

namespace App\Models\DataContent\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Addons;

class PackageAddons extends Model
{
    use HasFactory;

    protected $fillable = ['package_id','addons_id','counter'];

    public function package()
    {
        return $this->belongsTo(Package::class)->select('id','title','slug');
    }

    public function addons()
    {
        return $this->belongsTo(Addons::class)->select('id','title','slug','charge');
    }
}
