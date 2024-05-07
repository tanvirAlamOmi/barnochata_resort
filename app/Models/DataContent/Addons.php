<?php

namespace App\Models\DataContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'title', 'description', 'charge'];

    protected $appends = array('charge_currency');

    public function getChargeCurrencyAttribute()
    {
        return $this->attributes['charge'].' '.config('app.base_currency');
    }

    public function getDefaultImageAttribute($value)
    {
        if ($value){
            return asset("/img-contents/data-images/".$value);
        }
        return null;
    }
}
