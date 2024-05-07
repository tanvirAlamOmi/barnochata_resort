<?php

namespace App\Models\WebContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Settings\Section;
use App\Models\WebContent\TextContent;

class VideoContent extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','text_content_id','type','title','vdo_link_thumbnail','vdo_link','embed_code','vdo_file','description','serial_no','status'];

    protected $appends = array('thumbnail_path');

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function text_content()
    {
        return $this->belongsTo(TextContent::class);
    }

    public function getThumbnailPathAttribute()
    {
        return asset("/img-contents/content-images/".$this->attributes['vdo_link_thumbnail']);
    }
}
