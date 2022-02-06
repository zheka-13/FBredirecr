<?php

namespace App\Http\Controllers;


use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function show_login_form(Request $request)
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
    public function login(Request $request, UserService $userService): RedirectResponse
    {
        $userService->login($request->input('inputEmail'), $request->input('inputPassword'));
        return new RedirectResponse(route("home"));
    }


    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        app('session')->invalidate();
        return new RedirectResponse(route("login"));
    }
}
