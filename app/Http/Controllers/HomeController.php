<?php

namespace App\Http\Controllers;


use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\UserService;
use App\Enums\LanguagesEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function login(Request $request)
    {
        if (!empty($request->user())){
            return view('home', ['title' => 'Home']);
        }
        return view('login', ['title' => 'Login']);
    }

    /**
     * @param Request $request
     * @param UserService $userService
     * @return RedirectResponse
     * @throws UserEntityException
     */
    public function do_login(Request $request, UserService $userService): RedirectResponse
    {
        $userService->login($request->input('inputEmail'), $request->input('inputPassword'));
        return new RedirectResponse(route("home"));
    }


    public function logout()
    {
        app('session')->invalidate();
        return new RedirectResponse(route("login"));
    }
}
