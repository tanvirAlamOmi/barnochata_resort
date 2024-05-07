<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use App\Models\DataContent\Addons;
use Illuminate\Http\Request;
use App\Helpers\ImageUploadHelper;

class AddonsController extends Controller
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
        $addons = Addons::orderBy('id','DESC')->paginate(10);
        return view('dashboard.data-contents.addons.addons-list', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        return view('dashboard.data-contents.addons.addons-inputs', compact('editRow'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'charge' => ['nullable', 'numeric', 'min:0'],
            // 'status' => ['nullable', 'boolean'], // validate
            
            
            // $table->string('type')->nullable(); 
            // $table->string('slug')->unique(); 
        ]); 
        
        $addons = new Addons;
        $addons->title = $request->title;
        $addons->slug = titleToSlug($addons->title);
        $addons->description = $request->description;
        $addons->charge = $request->charge; 
        $addons->status = $request->status ? true : false; 
        $addons->serial_no = $request->serial_no;

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $addons->default_image, 5248576, $width, $height, $addons->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $addons->default_image = $image_name;
        }

        $addons->save();

        return redirect()->route('addons.index')->with('messege_success','Addons has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $addons = Addons::find($id);
       return view('dashboard.data-contents.addons.addons-show', compact('addons'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Addons::find($id);
        return view('dashboard.data-contents.addons.addons-inputs', compact('editRow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'charge' => ['nullable', 'numeric', 'min:0'],
        ]);

        $addons = Addons::find($id);
        $addons->title = $request->title;
        $addons->slug = titleToSlug($addons->title);
        $addons->description = $request->description;
        $addons->charge = $request->charge; 
        $addons->status = $request->status ? true : false; 
        $addons->serial_no = $request->serial_no;

        if($request->delete_existing_image == 'yes'){
            $this->imageHelper->deleteImage('data-images',$addons->default_image);
            $addons->default_image = null;
        }

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $addons->default_image, 5248576, $width, $height, $addons->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $addons->default_image = $image_name;
        }

        $addons->update();

        return redirect()->route('addons.index')->with('messege_success','Addons has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addons = Addons::find($id);

        if(!empty($addons->default_image)){
            $this->imageHelper->deleteImage('data-images',$addons->default_image);
            $addons->default_image = null;
        }

        $addons->delete();

        return redirect()->route('addons.index')->with('messege_success','Addons has been deleted successfully!');
    }

    public function status(Request $request){
        $addons = Addons::find($request->id);
        $addons->status = $addons->status ? false : true;
        $addons->update();
    }
}
