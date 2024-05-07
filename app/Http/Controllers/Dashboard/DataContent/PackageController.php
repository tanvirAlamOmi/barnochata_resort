<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Package\PackageRoom;
use App\Models\DataContent\Package\PackageAddons;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Addons;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with(['package_rooms.room','package_addons.addons'])->get();
        return view('dashboard.data-contents.packages.package-list', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        $rooms = Room::whereStatus(true)->orderBy('serial_no','ASC')->get();
        $addons = Addons::whereStatus(true)->orderBy('id','ASC')->get();
        return view('dashboard.data-contents.packages.package-inputs', compact('editRow','rooms','addons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'duration' => 'required',
            'duration' => 'required',
            'rooms' => 'required',
            'price' => 'required',
            'addons' => 'required',
            'addons_counter' => 'required',
        ]);

        $package = new Package;
        $package->title = $request->title;
        $package->slug = titleToSlug($package->title);
        $package->type = $request->type;
        $package->duration = $request->duration;
        $package->description = $request->description;
        $package->start_date = !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null ;
        $package->end_date = !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null ;
        $package->status = $request->status ? true : false;
        $package->save();

        if(count($request->rooms) > 0){
            foreach ($request->rooms as $r => $roomId) {
                $package_room = new PackageRoom;
                $package_room->package_id = $package->id;
                $package_room->room_id = $roomId;
                $package_room->default_guest = $request->default_guest[$r];
                $package_room->price = $request->price[$r];
                $package_room->extra_person_per_adult = $request->extra_person_per_adult[$r];
                $package_room->extra_person_per_child = $request->extra_person_per_child[$r];
                $package_room->save();
            }
        }

        if(count($request->addons) > 0){
            foreach ($request->addons as $s => $addonsId) {
                $package_addons = new PackageAddons;
                $package_addons->package_id = $package->id;
                $package_addons->addons_id = $addonsId;
                $package_addons->counter = $request->addons_counter[$s];
                $package_addons->save();
            }
        }

        return redirect()->route('packages.index')->with('message_success', 'Package has been created successfully!');
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
        $editRow = Package::with(['package_rooms.room','package_addons.addons'])->find($id);
        $rooms = Room::whereStatus(true)->orderBy('serial_no','ASC')->get();
        $addons = Addons::whereStatus(true)->orderBy('id','ASC')->get();
        return view('dashboard.data-contents.packages.package-inputs', compact('editRow','rooms','addons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'duration' => 'required',
            'duration' => 'required',
            'rooms' => 'required',
            'price' => 'required',
            'addons' => 'required',
            'addons_counter' => 'required',
        ]);

        $package = Package::with(['package_rooms','package_addons'])->find($id);
        $package->title = $request->title;
        $package->slug = titleToSlug($package->title);
        $package->type = $request->type;
        $package->duration = $request->duration;
        $package->description = $request->description;
        $package->start_date = !empty($request->start_date) ? date('Y-m-d', strtotime($request->start_date)) : null ;
        $package->end_date = !empty($request->end_date) ? date('Y-m-d', strtotime($request->end_date)) : null ;
        $package->status = $request->status ? true : false;
        $package->update();

        foreach ($package->package_rooms as $p => $package_room) {
            if(!in_array($package_room->id, $request->rooms)){
                PackageRoom::find($package_room->id)->delete();
            }
        }

        $package_rooms_id = $package->package_rooms->pluck('room_id')->toArray();

        if(count($request->rooms) > 0){
            foreach ($request->rooms as $r => $roomId) {
                if(in_array($roomId, $package_rooms_id))
                {
                    $package_room = PackageRoom::where('package_id',$package->id)->where('room_id', $roomId)->first();
                    $package_room->default_guest = $request->default_guest[$r];
                    $package_room->price = $request->price[$r];
                    $package_room->extra_person_per_adult = $request->extra_person_per_adult[$r];
                    $package_room->extra_person_per_child = $request->extra_person_per_child[$r];
                    $package_room->update();
                }else{
                    $package_room = new PackageRoom;
                    $package_room->package_id = $package->id;
                    $package_room->room_id = $roomId;
                    $package_room->default_guest = $request->default_guest[$r];
                    $package_room->price = $request->price[$r];
                    $package_room->extra_person_per_adult = $request->extra_person_per_adult[$r];
                    $package_room->extra_person_per_child = $request->extra_person_per_child[$r];
                    $package_room->save();
                }
            }
        }

        foreach ($package->package_addons as $s => $package_addons) {
            if(!in_array($package_addons->id, $request->addons)){
                PackageAddons::find($package_addons->id)->delete();
            }
        }

        $package_addons_id = $package->package_addons->pluck('addons_id')->toArray();

        if(count($request->addons) > 0){
            foreach ($request->addons as $s => $addonsId) {
                if(in_array($addonsId, $package_addons_id))
                {
                    $package_addons = PackageAddons::where('package_id', $package->id)->where('addons_id', $addonsId)->first();
                    $package_addons->counter = $request->addons_counter[$s];
                    $package_addons->save();
                }else{
                    $package_addons = new PackageAddons;
                    $package_addons->package_id = $package->id;
                    $package_addons->addons_id = $addonsId;
                    $package_addons->counter = $request->addons_counter[$s];
                    $package_addons->save();
                }
            }
        }

        return redirect()->route('packages.index')->with('message_success', 'Package has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(Request $request){
        $package = Package::find($request->id);
        $package->status = $package->status ? false : true;
        $package->update();
    }
}
