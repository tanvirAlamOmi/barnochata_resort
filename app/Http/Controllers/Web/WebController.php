<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataContent\Room\Room;
use App\Models\DataContent\Package\Package;
use App\Models\DataContent\Addons;
use App\Models\DataContent\Facility;
use App\Models\Settings\Menu;
use App\Models\Settings\Page;
use App\Models\Settings\Section;
use App\Helpers\BookingHelper;
use App\Models\WebContent\Message;

class WebController extends Controller
{
    protected $bookingHelper;

    public function __construct(BookingHelper $bookingHelper)
    {
        $this->bookingHelper = $bookingHelper;
    }

    public function home()
    {
        
        $slide_section = Section::with('active_image_contents')->where('name','HOME_SLIDER')->first();
        $slides = !empty($slide_section->active_image_contents) ? $slide_section->active_image_contents : null;

        $photo_section = Section::with('active_image_contents')->where('name','RECENT_PHOTOS')->first();

        $recent_photos = !empty($photo_section->active_image_contents) ? $photo_section->active_image_contents : null ;
        $rooms = Room::select('id','title','slug','category','default_image','price','facilities','serial_no')->whereStatus(true)->orderBy('serial_no','ASC')->get();
        $addons = Addons::select('id','title','slug','type','default_image','charge','serial_no')->whereStatus(true)->orderBy('serial_no','ASC')->get();
        $packages = Package::select('id','type','title','slug','duration','serial_no')->with(['package_rooms.room','package_addons.addons'])->whereStatus(true)->orderBy('serial_no','ASC')->get();
        $outdoors = Facility::select('id','title','slug','type','default_image','serial_no')->where('type','outdoor')->whereStatus(true)->orderBy('serial_no','ASC')->get();
        return view('web.home', compact('slides','recent_photos','rooms','addons','packages','outdoors'));
    }

    public function book_now(Request $request)
    {
        $booking_request = $this->bookingHelper->fomate_booking_request($request);
        $rooms = Room::with('room_packages.package.package_addons','room_images')->where('status',true)->orderBy('serial_no','ASC')->get();
        $addons = Addons::select('id','title','slug','type','charge','serial_no')->where('status',true)->orderBy('serial_no','ASC')->get();

        return view('web.book-now', compact('booking_request','rooms','addons'));
    }

    public function confirm_booking(Request $request)
    {
        $booking_request = $this->bookingHelper->fomate_booking_request($request);
        $cart_items = $this->bookingHelper->confirm_booking($request);
        
        return view('web.confirm-booking', compact('booking_request','cart_items'));
    }

    public function submit_confirmation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required|max:11|min:11',
            'from_date' => 'required',
            'total_adult' => 'required'
        ]);

        $booking_no = $this->bookingHelper->submit_confirmation($request);
        $message = 'Your booking has been submitted successfully. Thank you very much to be with us. Please, check your email for your booking information.';
        $email = $request->email;

        return redirect()->route('booking-successfull', ['booking_no' => $booking_no, 'email' => $email]);

        return view('web.booking-successful', compact('booking_no','message','email'));
    }

    public function room_details($slug)
    {
        $room = Room::with('room_packages.package.package_addons','room_images')->whereSlug($slug)->first();
        return view('web.room-details', compact('room'));
    }

    public function rooms_suits()
    {
        $rooms = Room::select('id','title','slug','category','default_image','price','facilities','serial_no')->whereStatus(true)->orderBy('serial_no','ASC')->get();
        return view('web.rooms-suits', compact('rooms'));
    }

    public function contact()
    {
        $app_infos = json_decode(file_get_contents(config_path('app-info.json')), true);
        return view('web.contact', compact('app_infos'));

    }

    public function gallery()
    {
        $gallery_section = Section::with('active_image_contents')->where('name','GALLERY_IMAGES')->first();
        $gallery_images = !empty($gallery_section->active_image_contents) ? $gallery_section->active_image_contents : null ;
        return view('web.gallery', compact('gallery_images'));
    }

    public function payment()
    {
        $booking = '';
        return view('web.payment', compact('booking'));
    }

    public function search_booking(Request $request)
    {
        $booking = $this->bookingHelper->get_booking($request->booking_no);
        return view('web.payment', compact('booking'));
    }

    public function services($slug = null)
    {
        return view('web.services');
    }

    public function terms_conditions()
    {
        $conditions_section = Section::with('active_text_contents')->where('name','TERMS_&_CONDITIONS')->first();
        $conditions = !empty($conditions_section->active_text_contents) ? $conditions_section->active_text_contents : null;
        return view('web.terms-conditions', compact('conditions'));
    }

    public function privacy_policy()
    {
        $policy_section = Section::with('active_text_contents')->where('name','PRIVACY_POLICY')->first();
        $privacy_policies = !empty($policy_section->active_text_contents) ? $policy_section->active_text_contents : null;
        return view('web.privacy-policy', compact('privacy_policies'));
    }

    public function faq()
    {
        $faq_section = Section::with('active_text_contents')->where('name','FAQ')->first();
        $faqs = !empty($faq_section->active_text_contents) ? $faq_section->active_text_contents : null ;
        return view('web.faq', compact('faqs'));
    }

    public function directors()
    {
        $directors_section = Section::with('active_image_contents')->where('name','DIRECTORS')->first();
        $directors = !empty($directors_section->active_image_contents) ? $directors_section->active_image_contents : null;
        return view('web.directors', compact('directors'));
    }

    public function design_samples()
    {
        return view('web.design-samples');
    }

    public function outdoors($slug)
    {
        $images = [];
        $description = null;

        $menu = Menu::with('page')->whereSlug($slug)->first();

        if(!empty($menu->page))
        {
            $page_id = $menu->page->id;
            
            $sections = Section::with(['active_image_contents','active_text_contents'])->wherePageId($page_id)->get();

            if(count($sections) > 0)
            {
                foreach ($sections as $key => $section) {
                    if($section->type == 'groupContent')
                    {
                        $images = $section->active_image_contents;
                    }
                    if($section->type == 'msWord')
                    {
                        $description = !empty($section->active_text_contents) && count($section->active_text_contents) > 0 ? $section->active_text_contents[0]->description : '';
                    }
                }
            }
        }

        return view('web.outdoor-details', compact('slug','images','description'));
    }

    public function service_facilities($slug)
    {
        $articles = [];
        $menu = Menu::with('page')->whereSlug($slug)->first();

        if(!empty($menu->page))
        {
            $page_id = $menu->page->id;
            
            $section = Section::with(['active_text_contents.active_image_contents','active_text_contents.active_video_contents'])->wherePageId($page_id)->first();

            $articles = $section->active_text_contents;

            foreach ($articles as $key => $article) {
                $article->images = $article->active_image_contents;
                $article->videos = $article->active_video_contents;
            }
        }

        return view('web.service-details', compact('slug','articles'));
    }
    
    public function submit_message(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:18|min:11',
            'message' => 'required',
        ]);

        $message = new Message($request->all());
        $message->save();
        return back()->with('message_success', 'Your message has been sent. we will reach you within 24hrs');

    }

    public function getAppInfo() {
        $app_infos = json_decode(file_get_contents(config_path('app-info.json')), true);
        return $app_infos;
    }

}
