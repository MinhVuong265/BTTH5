<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request)
    // {
    //     $user = User::find($request->user()->id);
        // $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
            
    //     }
    //     if ($request->hasFile('avatar')) {
    //         if($user->avatar) {
    //             Storage::delete($user->avatar);
    //         }

    //         // Lưu ảnh mới
    //         $path = $request->file('avatar')->store('avatars', 'public');
    //         $user->avatar = $path;
    //         echo "có ảnh";
    //     }
    //     else echo "ko có ảnh";
    //     // else $user->avatar = 'none';
    //     // echo $user->avatar;
    //     //  dd($user->avatar);
        
    //     // $request->user()->save();
    //     // $user = User::find($request->user()->id);
    //     $user->name = $request['name'];
    //     $user->bio = $request['bio'];
    //     $user->email = $request['email'];

    //     $user->save();
        
    //     // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(ProfileUpdateRequest $request):RedirectResponse
    {
        $user = $request->user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->hasFile('avatar')){
            if($user->avatar){
                Storage::delete('public/avatars/'.$user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        
        $user->save();
        // $avatarPath = Storage::url($request->avatar);

        // $user->avatar = $avatarPath;
        // dd($user->avatar);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
