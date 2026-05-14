<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('Admin.profile.index', compact('user'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('User_avatars', 'public');
        }

        $user->update($data);

        session()->flash('success', 'Profile updated successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('error', 'Current password does not match!');
            return redirect()->back();
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        session()->flash('success', 'Password updated successfully!');
        return redirect()->back();
    }
}
