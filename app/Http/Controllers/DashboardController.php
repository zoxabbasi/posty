<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('dashboard');
    }
}
