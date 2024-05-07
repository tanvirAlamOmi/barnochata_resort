<?php

namespace App\Models\WebContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Settings\Section;
use App\Models\WebContent\ImageContent;
use App\Models\WebContent\FileContent;
use App\Models\WebContent\VideoContent;

class TextContent extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','type','title','image','description','serial_no','status','created_by','updated_by'];

    protected $appends = array('image_path');

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getImagePathAttribute()
    {
        return asset("/img-contents/content-images/".$this->attributes['image']);
    }

    public function image_contents()
    {
        return $this->hasMany(ImageContent::class)->orderBy('serial_no','ASC');
    }

    public function active_image_contents()
    {
        return $this->hasMany(ImageContent::class)->where('status',true)->orderBy('serial_no','ASC');
    }

    public function file_contents()
    {
        return $this->hasMany(FileContent::class)->orderBy('serial_no','ASC');
    }

    public function active_file_contents()
    {
        return $this->hasMany(FileContent::class)->where('status',true)->orderBy('serial_no','ASC');
    }

    public function video_contents()
    {
        return $this->hasMany(VideoContent::class)->orderBy('serial_no','ASC');
    }

    public function active_video_contents()
    {
        return $this->hasMany(VideoContent::class)->where('status',true)->orderBy('serial_no','ASC');
    }
}
