<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->view('cms.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_name' => 'required|string|min:3|max:20',
            'user_email' => 'required|string|email|unique:admins,email',
            'user_image' => 'required|image|mimes:jpg,png|max:1024',
            'user_password' => [
                'required','string',
                RulesPassword::min(8)
                ->letters()
                ->numbers()
                ->symbols()
                ->mixedCase()
                ->uncompromised()
                ]
        ]);

        $admin = new Admin();
        $admin->name = $request->input('user_name');
        $admin->email = $request->input('user_email');
        $admin->password = Hash::make($request->input('user_password'));
        if ($request->hasFile('user_image')) {
            $file = $request->file('user_image');
            $image_name = time() . '_image_' . $admin->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("admins", $image_name,['disk' => 'public']);
            $admin->image = "admins/" . $image_name;
        }
        $saved = $admin->save();
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return response()->view('cms.admins.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|min:3|max:20',
            'user_email' => 'required|string|email|unique:admins,email,' . $id,
        ]);


        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('user_name');
        $admin->email = $request->input('user_email');
        $saved = $admin->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $admin = Admin::findOrFail($id);
        $deleted = $admin->delete();
        if ($deleted) {
            Storage::delete($admin->image);
        }
        return redirect()->back();
    }
}
