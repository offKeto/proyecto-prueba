<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function returnContactView()
    {
        $user = Auth::user();
        return view('contact', compact('user'));
    }
}
