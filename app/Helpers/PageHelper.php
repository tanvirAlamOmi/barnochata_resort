<?php

namespace App\Helpers;

use App\Models\Settings\Menu;
use App\Models\Settings\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PageHelper
{
    public function generateStaticPage($slug)
    {
        $menu = Menu::where('slug',$slug)->first();

        $page = new Page;
        $page->menu_id = $menu->id;
        $page->title = slugToTitle($slug);
        $page->type = 'static';
        $page->status = true;
        $page->save();

        // Get the view path
        $viewPath = base_path('resources/views/web');

        // Create a new blade file
        $fileName = $slug.'.blade.php';
        $fileContents = file_get_contents(base_path('resources/views/web/sample-page.blade.php'));

        $fileContents = str_replace('slug', slugToTitle($slug), $fileContents);

        // Write the file to disk
        File::put($viewPath . '/' . $fileName, $fileContents);
    }
}