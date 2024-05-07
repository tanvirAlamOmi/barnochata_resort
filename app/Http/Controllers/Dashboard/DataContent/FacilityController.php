<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use App\Models\DataContent\Facility;
use Illuminate\Http\Request;
use App\Helpers\ImageUploadHelper;

class FacilityController extends Controller
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
        $facilities = Facility::orderBy('title','ASC')->paginate(10);
        return view('dashboard.data-contents.facilities.facility-list', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        return view('dashboard.data-contents.facilities.facility-inputs', compact('editRow'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['nullable', 'string', 'max:255','unique:facilities'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'string'],
        ]); 
        
        $facility = new Facility;
        $facility->type = $request->type; 
        $facility->title = $request->title;
        $facility->slug = str_replace(' ', '-', strtolower($request->title)); 
        $facility->description = $request->description;
        $facility->status = $request->status ? true : false; 
        $facility->serial_no = $request->serial_no;

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $facility->default_image, 5248576, $width, $height, $facility->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $facility->default_image = $image_name;
        }

        $facility->save();

        return redirect()->route('facilities.index')->with('messege_success','Facility has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $facility = Facility::find($id);
       return view('dashboard.data-contents.facilities.facility-show', compact('facility'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Facility::find($id);
        return view('dashboard.data-contents.facilities.facility-inputs', compact('editRow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => ['nullable', 'string', 'max:255','unique:facilities,title,'.$id],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'string'],
        ]);

        $facility = Facility::find($id);
        $facility->type = $request->type; 
        $facility->title = $request->title;
        $facility->slug = str_replace(' ', '-', strtolower($request->title)); 
        $facility->description = $request->description;
        $facility->status = $request->status ? true : false; 
        $facility->serial_no = $request->serial_no;

        if($request->delete_existing_image == 'yes'){
            $this->imageHelper->deleteImage('data-images',$facility->default_image);
            $facility->default_image = null;
        }

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $facility->default_image, 5248576, $width, $height, $facility->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $facility->default_image = $image_name;
        }
        $facility->update();

        return redirect()->route('facilities.index')->with('messege_success','Facility has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facility = Facility::find($id);

        $facility->delete();

        return redirect()->route('facilities.index')->with('messege_success','Facility has been deleted successfully!');
    }

    public function status(Request $request){
        $facility = Facility::find($request->id);
        $facility->status = $facility->status ? false : true;
        $facility->update();
    }
} 
