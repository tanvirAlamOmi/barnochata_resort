<?php

namespace App\Http\Controllers\Dashboard\WebContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Section;
use App\Models\WebContent\TextContent;
use App\Models\WebContent\VideoContent;
use App\Helpers\ImageUploadHelper;

class TextContentController extends Controller
{
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
        return view('dashboard.web-contents.text-contents.text-content-inputs',compact('section','editRow'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'title' => 'required',
            // 'description' => 'required',
        ]);

        $section_type = Section::find($request->sectionId)->type;

        $last_entry_id = TextContent::latest('id')->pluck('id')->first() ?? 0 ;

        $textContent = new TextContent;
        $textContent->section_id = $request->sectionId;
        $textContent->title = $request->title;
        $textContent->title_icon = $request->title_icon;
        $textContent->description = $request->description;
        $textContent->link = $request->link;
        $textContent->serial_no = $request->serial_no;
        $textContent->status = $request->status ? true : false;

        if($section_type == 'article')
        {
            //
        }else{
            if ($request->hasFile('image')) {
                $width = $height = null;
                if($request->shape){
                    $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                    $width = $getShape['width'];
                    $height = $getShape['height'];
                }
                // 1 mb = 1048576 bytes in binary which is countable for the image size here
                $imageName = $this->imageHelper->uploadImageResizing(null, $request->image, 'content-images', $textContent->image, 5248576, $width, $height, ($last_entry_id+1).'-'.str_replace(' ', '-', $textContent->title), ['width' => null, 'height' => null, 'thumbStorageName' => null] );
                if($imageName == 'MaxSizeErr') {
                    return back()->with('message_warning', 'Too large file (max limit:1mb)');
                }
                $textContent->image = $imageName;
            }
        }

        $textContent->save();

        if(!empty($request->upload_video) && $request->upload_video == 'yes')
        {
            $video = new VideoContent;
            $video->section_id = $request->sectionId;
            $video->text_content_id = $textContent->id;
            $video->type = $request->video_type;

            if($video->type == 'embed_code')
            {
                $video->embed_code = $request->embed_code;
            }

            if($video->type == 'vdo_link')
            {
                $video->vdo_link = $request->vdo_link;

                if ($request->hasFile('vdo_link_thumbnail')) {
                    $width = $height = null;
                    $thumbnailName = $this->imageHelper->uploadImageResizing(null, $request->vdo_link_thumbnail, 'content-images', null, 5248576, $width, $height, ($last_entry_id+1).'-'.str_replace(' ', '-', $textContent->title).'vdo', ['width' => null, 'height' => null, 'thumbStorageName' => null] );
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

            $video->status = true;
            $video->save();

        }

        return redirect()->route('pages.show',$request->pageId)->with('message_success','Text Content has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * update status
     */
    public function status(string $id)
    {
        $textContent = TextContent::find($id);
        $textContent->status = !$textContent->status ? true : false ;
        $textContent->update();

        return back()->with('message_success','Content status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = TextContent::with('section')->find($id);
        $section = $editRow->section;
        return view('dashboard.web-contents.text-contents.text-content-inputs',compact('section','editRow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            // 'title' => 'required',
            // 'description' => 'required',
        ]);

        $textContent = TextContent::find($id);
        $textContent->title = $request->title;
        $textContent->title_icon = $request->title_icon;
        $textContent->description = $request->description;
        $textContent->link = $request->link;
        $textContent->serial_no = $request->serial_no;
        $textContent->status = $request->status ? true : false;

        if($request->delete_old_image == 'yes'){
            $this->imageHelper->deleteImage('content-images',$textContent->image);
            $textContent->image = null;
        }

        if ($request->hasFile('image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $imageName = $this->imageHelper->uploadImageResizing(null, $request->image, 'content-images', $textContent->image, 5248576, $width, $height, $textContent->id.'-'.str_replace(' ', '-', $textContent->title), ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($imageName == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:1mb)');
            }
            $textContent->image = $imageName;
        }

        $textContent->update();

        return redirect()->route('pages.show',$request->pageId)->with('message_success','Text Content has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $textContent = TextContent::with(['image_contents','video_contents','file_contents'])->find($id);

        // image contents
        if($textContent->image_contents->count() > 0)
        {
            foreach ($textContent->image_contents as $ti => $get_text_image) {
                $image = ImageContent::find($get_text_image->id);
                // check existing image
                if($image != null) {
                    $this->imageHelper->deleteImage('content-images',$image->image);
                }
                $image->delete();
            }
        }
        // file contents
        if($textContent->file_contents->count() > 0)
        {
            foreach ($textContent->file_contents as $ti => $get_text_file) {
                $file = FileContent::find($get_text_file->id);
                // check existing image
                if($file != null) {
                    // if (Storage::disk('content-files')->has($file->file)) {
                    //     Storage::disk('content-files')->delete($file->file);
                    // }
                }
                $file->delete();
            }
        }
        // video contents
        if($textContent->video_contents->count() > 0)
        {
            foreach ($textContent->video_contents as $ti => $get_text_video) {
                $video = VideoContent::find($get_text_video->id);
                $video->delete();
            }
        }
        $this->imageHelper->deleteImage('content-images',$textContent->image);
        $textContent->delete();

        return back()->with('message_success','Text Content has been deleted successfully.');
    }
}
