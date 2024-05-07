<?php

namespace App\Http\Controllers\Dashboard\WebContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Section;
use App\Models\WebContent\VideoContent;
use App\Models\WebContent\TextContent;
use App\Helpers\ImageUploadHelper;

class VideoContentController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageUploadHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $editRow = '';
        $section = Section::find($request->sectionId);
        $textContent = !empty($request->textContentId) ? TextContent::find($request->textContentId) : null;
        return view('dashboard.web-contents.video-contents.video-content-inputs',compact('editRow','section','textContent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $last_entry_id = VideoContent::latest('id')->pluck('id')->first() ?? 0 ;

        $textContent = TextContent::find($request->textContentId);

        $section = Section::find($request->sectionId);

        $video = new VideoContent;
        $video->section_id = !empty($request->textContentId) ? null : $request->sectionId;
        $video->text_content_id = !empty($request->textContentId) ? $request->textContentId : null;
        $video->title = $request->title;
        $video->type = $request->video_type;
        $video->description = $request->description;

        if($video->type == 'embed_code')
        {
            $video->embed_code = $request->embed_code;
        }

        if($video->type == 'vdo_link')
        {
            $video->vdo_link = $request->vdo_link;

            if ($request->hasFile('vdo_link_thumbnail')) {
                $title = !empty($request->textContentId) ? $textContent->title : $section->name;
                $width = $height = null;
                $thumbnailName = $this->imageHelper->uploadImageResizing(null, $request->vdo_link_thumbnail, 'content-images', null, 5248576, $width, $height, ($last_entry_id+1).'-'.str_replace(' ', '-', $title).'vdo', ['width' => null, 'height' => null, 'thumbStorageName' => null] );
                if($thumbnailName == 'MaxSizeErr') {
                    return back()->with('message_warning', 'Too large file (max limit:1mb)');
                }
                $video->vdo_link_thumbnail = $thumbnailName;
            }
        }

        if($video->type == 'file')
        {
            // $video->vdo_file = $request->file;
        }

        $video->status = $request->status ? true : false;
        $video->save();

        return redirect()->route('pages.show',$request->pageId)->with('message_success','Video has been uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = VideoContent::with('text_content')->find($id);

        $section = $textContent = null;

        if(!empty($editRow->text_content_id))
        {
            $section = Section::find($editRow->text_content->section_id);
            $textContent = $editRow->text_content;
        }else{
            $section = Section::find($request->sectionId);
            $textContent = !empty($request->textContentId) ? TextContent::find($request->textContentId) : null;
        }
        
        return view('dashboard.web-contents.video-contents.video-content-inputs',compact('editRow','section','textContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $video = VideoContent::with(['section','text_content'])->find($id);
        $video->title = $request->title;
        $video->type = $request->video_type;
        $video->description = $request->description;

        if($video->type == 'embed_code')
        {
            $video->embed_code = $request->embed_code;
        }

        if($video->type == 'vdo_link')
        {
            $video->vdo_link = $request->vdo_link;

            if ($request->hasFile('vdo_link_thumbnail')) {
                $title = !empty($video->text_content) ? $video->text_content->title : $video->section->name;
                $width = $height = null;
                $thumbnailName = $this->imageHelper->uploadImageResizing(null, $request->vdo_link_thumbnail, 'content-images', $video->vdo_link_thumbnail, 5248576, $width, $height, $video->id.'-'.str_replace(' ', '-', $title).'vdo', ['width' => null, 'height' => null, 'thumbStorageName' => null] );
                if($thumbnailName == 'MaxSizeErr') {
                    return back()->with('message_warning', 'Too large file (max limit:1mb)');
                }
                $video->vdo_link_thumbnail = $thumbnailName;
            }
        }

        if($video->type == 'file')
        {
            // $video->vdo_file = $request->file;
        }

        $video->status = $request->status ? true : false;
        $video->update();

        return redirect()->route('pages.show',$request->pageId)->with('message_success','Video has been updated successfully.');
    }

    public function status(string $id)
    {
        $video = VideoContent::find($id);
        $video->status = !$video->status ? true : false ;
        $video->update();

        return back()->with('message_success','Video status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
