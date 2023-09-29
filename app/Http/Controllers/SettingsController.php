<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //
    public function settings()
    {
        return view('settings.settings');
    }
    public function account()
    {
        return view('settings.account');
    }
    public function update_profile(ProfileRequest $request)
    {
        //dd($request);
        $image = auth()->user()->image;
        if ($request->hasFile('image')) {
            if (auth()->user()->image) {
                Storage::delete(auth()->user()->image);
            }

            $image = $request->file('image')->store('public/profile_image');
            auth()->user()->update([
                'name' => $request->name,
                'status' => $request->status,
                'phone' => $request->phone,
                'profile_img' => $image
            ]);
        }

        auth()->user()->update([
            'status' => $request->status,
            'name' => $request->name,
            'phone' => $request->phone,

        ]);
        return back()->with('message', 'Successfully Updated');
    }
    public function friend_profile(User $user)
    {

        $media = Message::where('receiver_id', auth()->user()->id)
            ->where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at')
            ->get();
       
        return view('settings.friend_profile', compact('user', 'media'));
    }
}
