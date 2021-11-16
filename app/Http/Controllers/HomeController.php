<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use App\Lead;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('guest.home', compact('posts'));
    }

    public function listPostsApi(){
        return view('api.home');
    }

    public function contact(){
        return view('guest.contacts');
    }

    public function thankYou(){
        return view('guest.thank-you');
    }

    public function handleContactForm(Request $request){
        // salviamo a db i dati inseriti nel form di contatto
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        Mail::to('info@boolpress.com')->send(new SendNewMail($new_lead));
        return redirect()->route('guest.thank-you');
    }
}
