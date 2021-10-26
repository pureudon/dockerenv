<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class JobbookProfileController extends Controller
{
    public function index()
    {
        $htmltitle = "jobbookprofile";
        $menu = "jobbookprofile";
        $submenu = "jobbookprofile";
        return view('jobbookprofile.index',compact(
            'htmltitle',
            'menu',
            'submenu'
        ));
    }

    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->only('name', 'email'));

        if ($request->input('password')) {
            auth()->user()->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        return redirect()->route('jobbookprofile.index')->with('message', 'Profile saved successfully');
    }
}