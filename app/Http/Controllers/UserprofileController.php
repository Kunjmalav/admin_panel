<?php

namespace App\Http\Controllers;

use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserprofileController extends Controller
{
    public function showSignupForm()
    {

        return view('signup');
    }

    
    public function Signup(Request $request)
    {

        // dd($request);
        try {

            $request->validate([
                'name' => 'required',
                'mobile' => 'required|numeric|min:10',
                'password' => 'required|regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
                'photo_video' => 'required|mimes:jpeg,png,mp4',
            ]);

            $userprofile = Userprofile::create([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password')),
                'username' => $this->generateUniqueUsername($request->input('name'), $request->input('password')),

            ]);


            $media = $userprofile->addMediaFromRequest('photo_video')->toMediaCollection('profile_photo_video');
            $userprofile->media_id = $media->id;
            $userprofile->compressAndSaveImage($media->getPath()); 
            $userprofile->save();
            return redirect()->route('login.form')->with([
                'success' => 'User profile created successfully.',
                'username' => $userprofile->username,
                'password' => $request->input('password')
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error',  $e->getMessage());
        }

        // return view('signup');
    }

    private function generateUniqueUsername($name, $password)
    {
        $lastUsedNumber = Userprofile::max('id') ?? 0;

        return substr($name, 0, 2) . substr($password, -4) . sprintf('%03d', $lastUsedNumber + 1);
    }

    public function showLoginForm()
    {
        return view('login', [
            'username' => session('username') ?? '',
            'password' => session('password') ?? ''
        ]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required|regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/',
            ]);

            if (Auth::guard('userprofiles')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {

                $user = Auth::guard('userprofiles')->user();
                // dd('Authentication successful.', $user);

                if (Auth::guard('userprofiles')->check()) {

                    return redirect()->route('dashboard')->with('success', 'Login successful.');
                } else {
                    return redirect()->back()->with('error', 'Authentication failed.');
                }
            } else {

                return redirect()->back()->with('error', 'Invalid details. Please try again.');
            }
        } catch (\Exception $e) {



            return redirect()->back()->with('error', 'Error during login: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.form')->with('success', 'Logout successful!');
    }
}
