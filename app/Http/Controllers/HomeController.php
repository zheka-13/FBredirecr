<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function home()
    {
        return view('home', ['title' => 'Home']);
    }
    public function login()
    {
        return view('login', ['title' => 'Login']);
    }

    public function welcome()
    {
        return view('welcome', ['title' => 'Welcome']);
    }

    public function logout()
    {
        return new Response("Unauthorized", ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
