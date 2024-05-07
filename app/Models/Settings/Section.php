<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\WebContent\TextContent;
use App\Models\WebContent\ImageContent;
use App\Models\WebContent\FileContent;
use App\Models\WebContent\VideoContent;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['page_id','type','name','heading','property','image','display_type','serial_no','status','created_by','updated_by'];

    public function page()
    {
        return $this->belongsTo(Page::class)->select('id','title');
    }

    public function text_contents()
    {
        return $this->hasMany(TextContent::class)->orderBy('serial_no','ASC');
    }

    public function active_text_contents()
    {
        return $this->hasMany(TextContent::class)->where('status',true)->orderBy('serial_no','ASC');
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
        return $this->hasMany(FileContent::class)->where('status',true)->orderBy('serial_no','ASC');;
    }

    public function video_contents()
    {
        return $this->hasMany(VideoContent::class)->orderBy('serial_no','ASC');
    }

    public function active_video_contents()
    {
        return $this->hasMany(VideoContent::class)->where('status',true)->orderBy('serial_no','ASC');
    }

    public function article()
    {
        return $this->hasOne(TextContent::class);
    }
}
