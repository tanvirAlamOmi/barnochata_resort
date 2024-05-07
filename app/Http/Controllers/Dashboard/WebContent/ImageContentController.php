<?php

namespace App\Http\Controllers\Dashboard\WebContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Section;
use App\Models\WebContent\ImageContent;
use App\Models\WebContent\TextContent;
use App\Helpers\ImageUploadHelper;

class ImageContentController extends Controller
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
        return view('dashboard.web-contents.image-contents.multiple-image-content-inputs',compact('editRow','section','textContent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'mimes:jpg,jpeg,png,gif',
        ]);

        $pageId = Section::find($request->sectionId)->page_id;
        $shape = null;

        if (count($request->uploadedImages) > 0) {

            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
                $shape = $width.' * '.$height;
            }

            foreach ($request->uploadedImages as $k => $uploadedImage) {
                $image_name = '';
                $imageContent = new ImageContent;
                $imageContent->section_id = !empty($request->textContentId) ? null : $request->sectionId;
                $imageContent->text_content_id = !empty($request->textContentId) ? $request->textContentId : null;
                $imageContent->title = $request->title && $request->title[$k] ? $request->title[$k] : NULL;
                $imageContent->link = $request->link && $request->link[$k] ? $request->link[$k] : NULL;
                $imageContent->caption = $request->caption && $request->caption[$k] ? $request->caption[$k] : NULL;
                $imageContent->description = $request->description && $request->description[$k] ? $request->description[$k] : NULL;
                $imageContent->serial_no = $request->serialNo && $request->serialNo[$k] ? $request->serialNo[$k] : 0;
                $imageContent->status = true;
                $imageContent->shape = $shape;

                $encodeType = explode('/', explode(';', $uploadedImage)[0])[1];

                // 1 mb = 1048576 bytes in binary which is countable for the image size here
                $image_name = $this->imageHelper->uploadImageResizing($encodeType, $uploadedImage, 'content-images', null, 5248576, $width, $height, $imageContent->title.$k, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
                // get max size alert
                if($image_name == 'MaxSizeErr') {
                    return back()->with('message_warning', 'Too large file (max limit:1mb)');
                }

                $imageContent->image = $image_name;
                $imageContent->save();
            }
        }

        return redirect()->route('pages.show',$pageId)->with('message_success','Image has been created successfully.');
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
        $imageContent = ImageContent::find($id);
        $imageContent->status = !$imageContent->status ? true : false ;
        $imageContent->update();

        return back()->with('message_success','Slide Image status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = ImageContent::with(['section','text_content'])->find($id);
        $section = $editRow->section;
        $textContent = $editRow->text_content;
        return view('dashboard.web-contents.image-contents.image-content-inputs',compact('editRow','section','textContent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'image' => 'mimes:jpg,jpeg,png,gif',
        ]);

        $imageContent = ImageContent::find($id);
        $imageContent->title = $request->title ? $request->title : NULL;
        $imageContent->link = $request->link ? $request->link : NULL;
        $imageContent->caption = $request->caption ? $request->caption : NULL;
        $imageContent->description = $request->description ? $request->description : NULL;
        $imageContent->serial_no = $request->serial_no;
        $imageContent->status = $request->status ? true : false;
        
        if ($request->hasFile('image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('image'), 'content-images', $imageContent->image, 5248576, $width, $height, $imageContent->name, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:1mb)');
            }
            $imageContent->image = $image_name;
        }

        $imageContent->update();

        return redirect()->route('pages.show',$request->pageId)->with('message_success','Slide Image has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imageContent = imageContent::find($id);
        $this->imageHelper->deleteImage('content-images',$imageContent->image);
        $imageContent->delete();

        return back()->with('message_success','Slide Image has been deleted successfully.');
    }
}
