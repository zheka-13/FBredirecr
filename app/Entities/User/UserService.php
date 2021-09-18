<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserAlreadyExistsException;
use App\Entities\User\Exceptions\UserEntityException;

class UserService
{
    /**
     * @var UserStorage
     */
    private $userStorage;

    /**
     * @param UserStorage $userStorage
     */
    public function __construct(UserStorage $userStorage)
    {
        $this->userStorage = $userStorage;
    }

    /**
     * @return UserEntity[]
     * @throws UserEntityException
     */
    public function getUsers(): array
    {
        return $this->userStorage->get_users();
    }

    /**
     * @param UserEntity $user
     * @throws UserAlreadyExistsException
     */
    public function storeUser(UserEntity $user)
    {
        if ($this->userStorage->email_exists($user->getEmail())){
            throw new UserAlreadyExistsException();
        }
        $this->userStorage->store($user);
    }
}
