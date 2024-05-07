<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'type',
        'title',
        'subtitle',
        'image',
        'meta_keywords',
        'meta_description',
        'status'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class)->select('id','name','slug');
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->select('id','page_id','type','name','heading','property','serial_no','image','status')->orderBy('serial_no','ASC');
    }

    public function active_sections()
    {
        return $this->hasMany(Section::class)->select('id','page_id','type','name','heading','property','serial_no','image','status')->where('status',true)->orderBy('serial_no','ASC');
    }
}
