<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Page;
use App\Models\Settings\Menu;
use App\Helpers\ImageUploadHelper;

class PageController extends Controller
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
        // return storage_path('page-images');
        $pages = Page::select('id','menu_id','title','type','image','status')->with('menu')->orderBy('title','ASC')->get();
        return view('dashboard.settings.pages.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        $menus = Menu::select('id','name','slug')->where('type','page')->orderBy('name','ASC')->get();
        return view('dashboard.settings.pages.page-inputs', compact('editRow','menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            // 'image' => ['string', 'max:40',],
        ]);

        $page = new Page;
        $page->menu_id = $request->menu_id;
        $page->title = $request->title;
        $page->type = $request->type;
        $page->status = $request->status ? true : false ;

        if ($request->hasFile('image')) {
            $imageName = $this->imageHelper->uploadImage('page-images', $request->image, str_replace(' ', '-', $page->title));
            $page->image = $imageName;
        }

        $page->save();

        return redirect()->route('pages.index')->with('message_success','Page has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $editRow = '';
        $page = Page::select('id','type','title','subtitle','image','meta_keywords','meta_description','status')->with(['sections.image_contents','sections.text_contents.video_contents','sections.file_contents','sections.video_contents'])->find($id);
        return view('dashboard.settings.pages.page-details',compact('page','editRow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Page::find($id);
        $menus = Menu::select('id','name','slug')->where('type','page')->orderBy('name','ASC')->get();
        return view('dashboard.settings.pages.page-inputs', compact('editRow','menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            // 'image' => ['string', 'max:40',],
        ]);

        $page = Page::find($id);
        $page->menu_id = $request->menu_id;
        $page->title = $request->title;
        $page->type = $request->type;
        $page->status = $request->status ? true : false ;

        if($request->delete_old_image == 'yes'){
            $this->imageHelper->deleteImage('page-images',$page->image);
            $page->image = null;
        }

        if ($request->hasFile('image')) {
            $imageName = $this->imageHelper->uploadImage('page-images', $request->image, str_replace(' ', '-', $page->title), $page->image);
            $page->image = $imageName;
        }

        $page->update();

        return redirect()->route('pages.index')->with('message_success','Page has been created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
