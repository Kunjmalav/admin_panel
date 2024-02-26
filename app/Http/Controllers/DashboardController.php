<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userprofile;


class DashboardController extends Controller
{
    // public function index() {
       
    //     return view('dashboard');
        
    // }

    public function index()
    {
        $user = auth()->user();
        $userprofile = Userprofile::with('userMedia')->find($user->id);

        return view('dashboard', compact('user', 'userprofile'));
    }


}
