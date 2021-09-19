<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserEntityException;
use App\Entities\User\Exceptions\UserNotFoundException;
use Illuminate\Database\DatabaseManager;
use stdClass;

class UserStorage
{
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @param DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        return $this->db->table("users")
            ->where("email", "=", $email)
            ->exists();
    }

    /**
     * @param string $email
     * @return UserEntity
     * @throws UserEntityException
     * @throws UserNotFoundException
     */
    public function getUserByEmail(string $email): UserEntity
    {
        $data = $this->db->table("users")
            ->where("email", "=", $email)
            ->first();
        if (empty($data)){
            throw new UserNotFoundException();
        }
        return $this->makeUserEntity($data);
    }

    /**
     * @return UserEntity[]
     * @throws UserEntityException
     */
    public function getUsers(): array
    {
        $data = $this->db->table("users")->get();
        $users = [];
        foreach ($data as $row){
            $users[] = $this->makeUserEntity($row);
        }
        return $users;
    }

    /**
     * @param int $user_id
     * @return UserEntity
     * @throws UserEntityException
     * @throws UserNotFoundException
     */
    public function getUser(int $user_id): UserEntity
    {
        $data = $this->db->table("users")
            ->where("id", "=", $user_id)
            ->first();
        if (empty($data)){
            throw new UserNotFoundException();
        }
        return $this->makeUserEntity($data);
    }

    /**
     * @param UserEntity $user
     */
    public function store(UserEntity $user)
    {
        $data = $this->getDataForInsert($user);
        $this->db->table("users")->insert($data);
    }

    /**
     * @param UserEntity $user
     */
    public function update(UserEntity $user)
    {
        $data = $this->getDataForUpdate($user);
        $this->db
            ->table("users")
            ->where("id", "=", $user->getId())
            ->update($data);
    }

    /**
     * @param int $user_id
     */
    public function delete(int $user_id)
    {
        $this->db
            ->table("users")
            ->where("id", "=", $user_id)
            ->delete();
    }

    /**
     * @param stdClass $row
     * @return UserEntity
     * @throws UserEntityException
     */
    private function makeUserEntity(stdClass $row): UserEntity
    {
        $user = new UserEntity($row->email);
        return $user
            ->setId($row->id)
            ->setName($row->name)
            ->setPassword($row->password)
            ->setIsAdmin((bool)$row->is_admin);
    }

    /**
     * @param UserEntity $user
     * @return array
     */
    private function getDataForInsert(UserEntity $user): array
    {
        $data = [];
        $data['name'] = $user->getName();
        $data['email'] = $user->getEmail();
        $data['is_admin'] = $user->isIsAdmin();
        $data['password'] = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        return $data;
    }

    /**
     * @param UserEntity $user
     * @return array
     */
    private function getDataForUpdate(UserEntity $user): array
    {
        $data = [];
        $data['name'] = $user->getName();
        $data['is_admin'] = $user->isIsAdmin();
        if (!empty($user->getPassword())){
            $data['password'] = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        }
        return $data;
    }
}
