<?php

namespace App\Http\Controllers;



class RootController extends Controller
{

    public function root()
    {
        return view('welcome', ['title' => 'Welcome']);
    }

}
