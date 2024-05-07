<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Room\RoomImage;
use App\Models\DataContent\Facility;
use App\Helpers\ImageUploadHelper;

class RoomController extends Controller
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
        $rooms = Room::get();
        return view('dashboard.data-contents.rooms.room-list', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        $facilities = Facility::where('type','indoor')->where('status',true)->get();
        return view('dashboard.data-contents.rooms.room-inputs', compact('editRow','facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'category' => 'required',
            'guest_capacity' => 'required',
        ]);

        $room = new Room;
        $room->title = $request->title;
        $room->slug = titleToSlug($room->title);
        $room->category = $request->category;
        $room->price = $request->price;
        $room->extra_person_per_adult = $request->extra_person_per_adult;
        $room->extra_person_per_child = $request->extra_person_per_child;
        $room->description = $request->description;
        $room->facilities = !empty($request->facilities) ? implode(', ', $request->facilities) : null;
        $room->guest_capacity = $request->guest_capacity;
        $room->serial_no = $request->serial_no;
        $room->status = $request->status ? true : false;

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $room->default_image, 5248576, $width, $height, $room->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $room->default_image = $image_name;
        }

        $room->save();

        return redirect()->route('rooms.index')->with('messege_success','Room has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::with('room_images')->find($id);
        return view('dashboard.data-contents.rooms.room-view', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Room::find($id);
        $facilities = Facility::where('type','indoor')->where('status',true)->get();
        return view('dashboard.data-contents.rooms.room-inputs', compact('editRow','facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'category' => 'required',
            'guest_capacity' => 'required',
        ]);

        $room = Room::find($id);
        $room->title = $request->title;
        $room->slug = titleToSlug($room->title);
        $room->category = $request->category;
        $room->price = $request->price;
        $room->extra_person_per_adult = $request->extra_person_per_adult;
        $room->extra_person_per_child = $request->extra_person_per_child;
        $room->description = $request->description;
        $room->facilities = !empty($request->facilities) ? implode(', ', $request->facilities) : null;
        $room->guest_capacity = $request->guest_capacity;
        $room->serial_no = $request->serial_no;
        $room->status = $request->status ? true : false;

        if($request->delete_existing_image == 'yes'){
            $this->imageHelper->deleteImage('data-images',$room->default_image);
            $room->default_image = null;
        }

        if ($request->hasFile('default_image')) {
            $width = $height = null;
            if($request->shape){
                $getShape = $this->imageHelper->shapeMaker($request->shape, $request->width, $request->height);
                $width = $getShape['width'];
                $height = $getShape['height'];
            }
            // 1 mb = 1048576 bytes in binary which is countable for the image size here
            $image_name = $this->imageHelper->uploadImageResizing(null, $request->file('default_image'), 'data-images', $room->default_image, 5248576, $width, $height, $room->title, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
            if($image_name == 'MaxSizeErr') {
                return back()->with('message_warning', 'Too large file (max limit:5mb)');
            }
            $room->default_image = $image_name;
        }

        $room->update();

        return redirect()->route('rooms.index')->with('messege_success','Room has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function store_images(Request $request)
    {
        $this->validate($request,[
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        // return $request;
        // return $request->uploadedImages;

        if (count($request->uploadedImages) > 0) {

            $width = $height = null;

            foreach ($request->uploadedImages as $k => $uploadedImage) {
                $image_name = '';
                $room_image = new RoomImage;
                $room_image->room_id = $request->roomId;
                $room_image->serial_no = $request->serialNo && $request->serialNo[$k] ? $request->serialNo[$k] : 0;

                $encodeType = explode('/', explode(';', $uploadedImage)[0])[1];

                // 1 mb = 1048576 bytes in binary which is countable for the image size here
                $image_name = $this->imageHelper->uploadImageResizing($encodeType, $uploadedImage, 'data-images', null, 5248576, $width, $height, $request->room_title.date('ymdhis').$k, ['width' => null, 'height' => null, 'thumbStorageName' => null] );
                // get max size alert
                if($image_name == 'MaxSizeErr') {
                    return back()->with('message_warning', 'Too large file (max limit:1mb)');
                }

                $room_image->image = $image_name;
                $room_image->save();
            }
        }

        return redirect()->route('rooms.show',$request->roomId)->with('message_success', 'Room images have beed stored successfully.');
    }

    public function delete_image(Request $request)
    {
        $image = RoomImage::find($request->id);
        $this->imageHelper->deleteImage('data-images',$image->image);
        $image->delete();
    }
}
