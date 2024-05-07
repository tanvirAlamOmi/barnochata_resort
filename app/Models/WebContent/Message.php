<?php

namespace App\Models\WebContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'email', 'phone', 'phone', 'message', 'status', 'is_seen'];
}
