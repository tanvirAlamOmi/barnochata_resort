<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Page;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'position',
        'type',
        'link_url',
        'display_options',
        'status'
    ];

    public function parent()
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id');
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->with('sub_submenus');
    }

    public function sub_submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function page()
    {
        return $this->hasOne(Page::class)->where('status', true);
    }
}
