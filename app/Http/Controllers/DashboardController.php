<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index() {
        // dd(auth()->user());
        // To check if the user has been signed in

        // dd(auth()->user()->posts);
        // This will return a collection

        // $user = auth()->user();
        // Grabing currently signed in user to send an email
        // Mail::to($user)->send(new PostLiked());

        return view('dashboard');
    }
}
