<?php

namespace App\Models\WebContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Settings\Section;
use App\Models\WebContent\TextContent;

class ImageContent extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','text_content_id','image','shape','title','caption','link','description','serial_no','status'];

    protected $appends = array('image_path');

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function text_content()
    {
        return $this->belongsTo(TextContent::class);
    }

    public function getImagePathAttribute()
    {
        return asset("/img-contents/content-images/".$this->attributes['image']);
    }
}
