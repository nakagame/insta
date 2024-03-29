<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id) {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user', $user);
    }

    public function edit() {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request) {
        $request->validate([
            'name'         => 'required|min:1|max:255',
            'email'        => 'required|email|max:50|unique:users,email,'. Auth::user()->id,
            'introduction' => 'max:100',
            'avatar'       => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;

        if($request->avatar) {
            $user->avatar = 'data:image/'. $request->avatar->extension(). ';base64,'. base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($user_id) {
        $user = $this->user->findOrFail($user_id);

        return view('users.profile.followers')->with('user', $user);
    }

    public function following($user_id) {
        $user = $this->user->findOrFail($user_id);

        return view('users.profile.following')->with('user', $user);
    }
}
