<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User\UserEntityException;
use App\Entities\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return View
     * @throws UserEntityException
     */
    public function index(): View
    {
        $users = $this->userService->getUsers();
        return view('admin.users.list', ['title' => 'Users', "users" => $users]);
    }
}
