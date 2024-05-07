<?php

namespace App\Http\Controllers\Dashboard\WebContent;

use App\Http\Controllers\Controller;
use App\Models\WebContent\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Message::orderBy('created_at','DESC')->paginate(10);
        return view('dashboard.web-contents.messages.contact-message', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $contact = Message::find($id);
       return view('dashboard.web-contents.messages.contact-message-show', compact('contact'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Message::find($id);

        $contact->delete();

        return redirect()->route('contact-messages.index')->with('messege_success','Message has been deleted successfully!');
    }

    public function status(Request $request){
        $contact = Message::find($request->id);
        $contact->status = $contact->status ? false : true;
        $contact->update();
    }
}
