<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function profile(){
        return view('admin.profile');
    }
    public function generateToken(){
        $api_token = Str::random(80);

        // Assegniamo all'utente corrente l'api token
        $user = Auth::user();
        $user->api_token = $api_token;
        $user->save();
        
        return redirect()->route('admin.profile');
    }
}
