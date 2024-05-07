<?php

namespace App\Http\Controllers\Dashboard\DataContent;

use App\Http\Controllers\Controller;
use App\Models\DataContent\Booking\Guest;
use App\Models\DataContent\Booking\Booking;
use Illuminate\Http\Request;
use App\Helpers\ImageUploadHelper;

class GuestController extends Controller
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
        $guests = Guest::orderBy('id','DESC')->paginate(20);
        return view('dashboard.data-contents.guests.guest-list', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($booking_id = null)
    {
        $editRow = '';
        $bookings = Booking::select('id','booking_no','name','email','contact_no')->where('status',5)->orderBy('booking_no','DESC')->get();
        return view('dashboard.data-contents.guests.guest-inputs', compact('editRow','bookings','booking_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'booking_id' => ['required'],
            'booking_no' => ['required'],
            'type' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
        ]);

        if($request->type == 'foreign')
        {
            $this->validate($request, [
                'passport_no' => ['required'],
                'passport_issue_place' => ['required'],
                'passport_issue_date' => ['required'],
                'visa_imm_no' => ['required'],
                'coming_from' => ['required'],
                'going_to' => ['required'],
                'expected_langth_of_staying' => ['required'],
                'date_of_entry_in_bd' => ['required'],
                'purpose_of_visit' => ['required'],
            ]);
        }
        
        $guest = new Guest;
        $guest->booking_id = $request->booking_id;
        $guest->booking_no = $request->booking_no;
        $guest->type = $request->type; 
        $guest->title = $request->title;
        $guest->full_name = $request->full_name;
        $guest->address = $request->address;
        $guest->profession = $request->profession;
        $guest->nationality = $request->nationality;
        $guest->dob = !empty($request->dob) ? date('Y-m-d', strtotime($request->dob)) : null;
        $guest->nid = $request->nid;
        $guest->email = $request->email;
        $guest->mobile_no = $request->mobile_no;
        $guest->company_name = $request->company_name;
        $guest->company_address = $request->company_address;
        $guest->company_mobile_no = $request->company_mobile_no;
        $guest->vehicle_no = $request->vehicle_no;
        $guest->passport_no = $request->passport_no;
        $guest->passport_issue_place = $request->passport_issue_place;
        $guest->passport_issue_date = !empty($request->passport_issue_date) ? date('Y-m-d', strtotime($request->passport_issue_date)) : null;
        $guest->visa_imm_no = $request->visa_imm_no;
        $guest->coming_from = $request->coming_from;
        $guest->going_to = $request->going_to;
        $guest->expected_langth_of_staying = $request->expected_langth_of_staying;
        $guest->date_of_entry_in_bd = !empty($request->date_of_entry_in_bd) ? date('Y-m-d', strtotime($request->date_of_entry_in_bd)) : null;
        $guest->purpose_of_visit = $request->purpose_of_visit;
        $guest->save();

        return redirect()->route('bookings.show',$request->booking_no)->with('messege_success','Guest has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       return $guest = Guest::find($id);
       return view('dashboard.data-contents.guests.guest-show', compact('guest'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editRow = Guest::find($id);
        $bookings = Booking::select('id','booking_no','name','email','contact_no')->where('status',5)->orderBy('booking_no','DESC')->get();
        $booking_id = $editRow->booking_id;
        return view('dashboard.data-contents.guests.guest-inputs', compact('editRow','bookings','booking_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'booking_id' => ['required'],
            'type' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
        ]);

        if($request->type == 'foreign')
        {
            $this->validate($request, [
                'passport_no' => ['required'],
                'passport_issue_place' => ['required'],
                'passport_issue_date' => ['required'],
                'visa_imm_no' => ['required'],
                'comming_from' => ['required'],
                'going_to' => ['required'],
                'expected_langth_of_staying' => ['required'],
                'date_of_entry_in_bd' => ['required'],
                'purpose_of_visit' => ['required'],
            ]);
        }
        
        $guest = Guest::find($id);
        $guest->type = $request->type; 
        $guest->title = $request->title;
        $guest->full_name = $request->full_name;
        $guest->address = $request->address;
        $guest->profession = $request->profession;
        $guest->nationality = $request->nationality;
        $guest->dob = !empty($request->dob) ? date('Y-m-d', strtotime($request->dob)) : null;
        $guest->nid = $request->nid;
        $guest->email = $request->email;
        $guest->mobile_no = $request->mobile_no;
        $guest->company_name = $request->company_name;
        $guest->company_address = $request->company_address;
        $guest->company_mobile_no = $request->company_mobile_no;
        $guest->vehicle_no = $request->vehicle_no;
        $guest->passport_no = $request->passport_no;
        $guest->passport_issue_place = $request->passport_issue_place;
        $guest->passport_issue_date = !empty($request->passport_issue_date) ? data('Y-m-d', strtotime($request->passport_issue_date)) : null;
        $guest->visa_imm_no = $request->visa_imm_no;
        $guest->coming_from = $request->coming_from;
        $guest->going_to = $request->going_to;
        $guest->expected_langth_of_staying = $request->expected_langth_of_staying;
        $guest->date_of_entry_in_bd = !empty($request->date_of_entry_in_bd) ? data('Y-m-d', strtotime($request->date_of_entry_in_bd)) : null;
        $guest->purpose_of_visit = $request->purpose_of_visit;
        $guest->update();

        return redirect()->route('bookings.show',$request->booking_no)->with('messege_success','Guest has been created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = Guest::find($id);

        $guest->delete();

        return redirect()->route('guests.index')->with('messege_success','guest has been deleted successfully!');
    }

    public function status(Request $request){
        $guest = Guest::find($request->id);
        $guest->status = $guest->status ? false : true;
        $guest->update();
    }
} 
