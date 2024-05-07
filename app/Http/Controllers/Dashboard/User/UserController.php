<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id','name','email','mobile_no','type','status','created_at')->whereNot('id',1)->orderBy('id','DESC')->get();
        return view('dashboard.users.user-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editRow = '';
        return view('dashboard.users.user-inputs', compact('editRow'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_no' => ['required', 'max:11', 'min:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->password = Hash::make($request->password);
        $user->type = 'client';
        $user->weight = 50;
        $user->status = true;
        $user->save();

        return redirect()->route('users.index')->with('messege_success','User has been created successfully!');
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
        $editRow = User::find($id);
        return view('dashboard.users.user-inputs', compact('editRow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'mobile_no' => ['required', 'max:11', 'min:11', 'unique:users,mobile_no,'.$id],
        ]);

        if($request->update_password){
            $this->validate($request, [
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;

        if($request->update_password){
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('users.index')->with('messege_success','User has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
