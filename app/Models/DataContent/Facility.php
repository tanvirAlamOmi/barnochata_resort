<?php

namespace App\Models\DataContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    
    protected $fillable = ['status', 'title', 'description'];

    public function getDefaultImageAttribute($value)
    {
        if ($value){
            return asset("/img-contents/data-images/".$value);
        }
        return null;
    }
}
