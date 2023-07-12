<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    // Adding middleware so that a person who is logged in cannot access this page

    public function index()
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd($request->remember);
        // The default checked value of a checkbox is on

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            // The attempt method will return us a boolean value
            // To add a remember token we pass it in as a second argument

            return back()->with('status', 'Invalid credientials');
            // back() is a shortcut to redirect the user to the last page he visited
            // with() which will flash a message to session, we can pick this up with if statement in login.blade.php
        };


        return redirect()->route('dashboard');

    }
}
