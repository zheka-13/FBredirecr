<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User\Exceptions\UserAlreadyExistsException;
use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\UserEntity;
use App\Entities\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function create(): View
    {
        return view('admin.users.create', ['title' => 'Create']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     * @throws UserEntityException
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'string|nullable',
                "email" => "email|required",
                "password" => "filled|required"
            ]);
        }
        catch (ValidationException $e) {
            $errors = json_decode($e->getResponse()->getContent(), true);
            return view('admin.users.create', ['title' => 'Create'])->with("errors", $errors);
        }
        try {
            $user = $this->makeUserEntityFromRequest($request);
            $this->userService->storeUser($user);
        }
        catch (UserAlreadyExistsException $e){
            $errors = [
                "email" => [
                    "User with email ".$request->input('email')." already exists"
                ]
            ];
            return view('admin.users.create', ['title' => 'Create'])->with("errors", $errors);
        }
        return redirect(route('admin.users'));
    }

    /**
     * @param Request $request
     * @return UserEntity
     * @throws UserEntityException
     */
    private function makeUserEntityFromRequest(Request $request): UserEntity
    {
        $user = new UserEntity($request->input('email'));
        return $user
            ->setIsAdmin($request->has("is_admin"))
            ->setPassword($request->input('password', "") ?? "")
            ->setName($request->input("name", "") ?? "");
    }
}
