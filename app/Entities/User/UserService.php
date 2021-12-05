<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserAlreadyExistsException;
use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\Exceptions\UserNotFoundException;
use App\Events\UserDeletedEvent;
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
     * @return bool
     * @throws UserEntityException
     */
    public function login(string $email, string $password): bool
    {
        try {
            $user = $this->userStorage->getUserByEmail($email);
        }
        catch (UserNotFoundException $e) {
            return false;
        }
        if (!empty($password) && password_verify($password, $user->getPassword())) {
            app('session')->put("user_id", $user->getId());
            return true;

        }
        return false;
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
     * @param int $user_id
     * @return User
     * @throws UserEntityException
     * @throws UserNotFoundException
     */
    public function getUserModel(int $user_id): User
    {
        $user = $this->getUser($user_id);
        return new User($user->asArray());
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

    /**
     * @param int $user_id
     * @throws UserEntityException
     * @throws UserNotFoundException
     */
    public function deleteUser(int $user_id)
    {
        $user = $this->getUser($user_id);
        $this->userStorage->delete($user_id);
        event(new UserDeletedEvent($user));
    }

    public function setUserLang(int $user_id, string $lang)
    {
        $this->userStorage->updateUserLang($user_id, $lang);
    }
}
