<?php

namespace App\Entities\User;

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
        return $this->userStorage->getUsers();
    }
}
