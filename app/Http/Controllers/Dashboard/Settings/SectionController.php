<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Page;
use App\Models\Settings\Section;
use App\Models\WebContent\ImageContent;
use App\Models\WebContent\TextContent;
use App\Models\WebContent\FileContent;
use App\Models\WebContent\VideoContent;

use App\Helpers\ImageUploadHelper;

class SectionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'type' => 'required',
            'property' => 'required',
        ]);

        $last_entry_id = Section::latest('id')->pluck('id')->first() ?? 0 ;

        $section = new Section;
        $section->page_id = $request->page_id;
        $section->name = strtoupper(str_replace(' ', '_', $request->name));
        $section->type = $request->type;

        if($section->type == 'groupContent')
        {
            $properties = $request->groupContentType.','.implode(',', $request->property);
        }elseif($section->type == 'msWord'){
            $properties = $section->type;
        }else{
            $properties = implode(',', $request->property);
        }

        $section->property = $properties;
        $section->serial_no = $request->serial_no ? $request->serial_no : 0;
        $section->status = $request->status ? true : false;
        
        if ($request->hasFile('image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $imageName = $this->imageHelper->uploadImageResizing(null, $request->image, 'section-images', $section->image, 5248576, $width, $height, ($last_entry_id+1).'-'.str_replace(' ', '-', $section->name), ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($imageName == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:1mb)');
            }
            $section->image = $imageName;
        }
        
        $section->save();

        return back()->with('message_success','Section has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update_heading(Request $request)
    {
        $section = Section::find($request->sectionId);
        $section->heading = $request->heading;
        $section->update();

        return back()->with('message_success','Section Heading has been updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Section::with('page')->find($id);
        return view('dashboard.settings.sections.section-inputs',compact('editRow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::find($id);
        $section->serial_no = $request->serial_no ? $request->serial_no : 0;
        $section->status = $request->status ? true : false;

        if($request->delete_old_image == 'yes'){
            $this->imageHelper->deleteImage('section-images',$section->image);
            $section->image = null;
        }
        
        if ($request->hasFile('image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('image'), 'section-images', $section->image, 5248576, $width, $height, $section->name, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:1mb)');
            }
            $section->image = $image_name;
        } elseif($request->delete_old_image == 'yes'){
            $this->imageHelper->deleteImage('section-images',$section->image);
            $section->image = null;
        }
        
        $section->update();

        return redirect()->route('pages.show',$request->page_id)->with('message_success',' Section has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::with(['text_contents','image_contents','file_contents','video_contents'])->find($id);

        if($section->text_contents->count() > 0)
        {
            foreach ($section->text_contents as $t => $get_text) {
                $text = TextContent::with(['image_contents','video_contents','file_contents'])->find($get_text->id);
                // image contents
                if($text->image_contents->count() > 0)
                {
                    foreach ($text->image_contents as $ti => $get_text_image) {
                        $image = ImageContent::find($get_text_image->id);
                        // check existing image
                        if($image != null) {
                            $this->imageHelper->deleteImage('content-images',$image->image);
                        }
                        $image->delete();
                    }
                }
                // file contents
                if($text->file_contents->count() > 0)
                {
                    foreach ($text->file_contents as $ti => $get_text_file) {
                        $file = FileContent::find($get_text_file->id);
                        // check existing image
                        if($file != null) {
                            if (Storage::disk('content-files')->has($file->file)) {
                                Storage::disk('content-files')->delete($file->file);
                            }
                        }
                        $file->delete();
                    }
                }
                // video contents
                if($text->video_contents->count() > 0)
                {
                    foreach ($text->video_contents as $ti => $get_text_video) {
                        $video = VideoContent::find($get_text_video->id);
                        $video->delete();
                    }
                }
                $text->delete();
            }
        }

        if($section->image_contents->count() > 0)
        {
            foreach ($section->image_contents as $ti => $get_section_image) {
                $image = ImageContent::find($get_section_image->id);
                // check existing image
                if($image != null) {
                    $this->imageHelper->deleteImage('content-images',$image->image);
                }
                $image->delete();
            }
        }

        // if($section->file_contents->count() > 0)
        // {
        //     foreach ($section->file_contents as $ti => $get_section_file) {
        //         $file = FileContent::find($get_section_file->id);
        //         // check existing image
        //         if($file != null) {
        //             if (Storage::disk('file_content')->has($file->file)) {
        //                 Storage::disk('file_content')->delete($file->file);
        //             }
        //         }
        //         $file->delete();
        //     }
        // }

        if($section->video_contents->count() > 0)
        {
            foreach ($section->video_contents as $ti => $get_section_video) {
                $video = VideoContent::find($get_section_video->id);
                $video->delete();
            }
        }

        if($section->image != null) {
            $this->imageHelper->deleteImage('section-images',$section->image);
        }

        $section->delete();

        return back()->with('message_success','Section has been deleted successfully.');
    }
}
