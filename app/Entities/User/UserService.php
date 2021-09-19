<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserAlreadyExistsException;
use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\Exceptions\UserNotFoundException;
use App\Models\User;

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
     * @param string $email
     * @param string $password
     * @return User|null
     * @throws UserEntityException
     */
    public function login(string $email, string $password): ?User
    {
        try {
            $user = $this->userStorage->getUserByEmail($email);
        }
        catch (UserNotFoundException $e) {
            return null;
        }
        if (!empty($password) && password_verify($password, $user->getPassword())) {
            return new User($user->asArray());

        }
        return null;
    }

    /**
     * @return UserEntity[]
     * @throws UserEntityException
     */
    public function getUsers(): array
    {
        return $this->userStorage->getUsers();
    }

    /**
     * @param int $user_id
     * @return UserEntity
     * @throws UserEntityException
     * @throws UserNotFoundException
     */
    public function getUser(int $user_id): UserEntity
    {
        return $this->userStorage->getUser($user_id);
    }

    /**
     * @param UserEntity $user
     * @throws UserAlreadyExistsException
     */
    public function storeUser(UserEntity $user)
    {
        if ($this->userStorage->emailExists($user->getEmail())){
            throw new UserAlreadyExistsException();
        }
        $this->userStorage->store($user);
    }

    /**
     * @param UserEntity $user
     */
    public function updateUser(UserEntity $user)
    {
        $this->userStorage->update($user);
    }
}
