<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::select('id','name','parent_id','type','position','link_url','display_options','status')->with('parent')->orderBy('position','ASC')->get();
        return view('dashboard.settings.menus.menus', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        $menus = Menu::select('id','name','parent_id','type','position')->where('type','navigation')->where('status', true)->with('parent')->orderBy('position','ASC')->get();
        return view('dashboard.settings.menus.menu-inputs', compact('editRow','menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:menus'],
            'type' => ['required', 'string'],
        ]);

        if($request->type == 'external_link'){
            $this->validate($request, [
                'link_url' => ['required', 'string']
            ]);
        }

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->slug = str_replace(' ', '-', strtolower($request->name));
        $menu->position = $request->position;
        $menu->parent_id = $request->parent_id;
        $menu->type = $request->type;
        $menu->display_options = !empty($request->display_options) ? implode(',', $request->display_options) : null;
        $menu->link_url = $menu->type == 'external_link' ? $request->link_url : null ;
        $menu->status = $request->status ? true : false ;
        $menu->save();

        return redirect()->route('menus.index')->with('message_success','Menu has been created successfully.');
        
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
        $editRow = Menu::find($id);
        $menus = Menu::select('id','name','parent_id','type','position')->where('type','navigation')->where('status', true)->with('parent')->orderBy('position','ASC')->get();
        return view('dashboard.settings.menus.menu-inputs', compact('editRow','menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255', 'unique:menus,name,'.$id],
            'type' => ['required', 'string'],
        ]);

        if($request->type == 'external_link'){
            $this->validate($request, [
                'link_url' => ['required', 'string']
            ]);
        }

        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->slug = str_replace(' ', '-', strtolower($request->name));
        $menu->position = $request->position;
        $menu->parent_id = $request->parent_id;
        $menu->type = $request->type;
        $menu->display_options = !empty($request->display_options) ? implode(',', $request->display_options) : null;
        $menu->link_url = $menu->type == 'external_link' ? $request->link_url : null ;
        $menu->status = $request->status ? true : false ;
        $menu->update();

        return redirect()->route('menus.index')->with('message_success','Menu has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
