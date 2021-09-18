<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserEntityException;
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
    public function email_exists(string $email): bool
    {
        return $this->db->table("users")
            ->where("email", "=", $email)
            ->exists();
    }

    /**
     * @return UserEntity[]
     * @throws UserEntityException
     */
    public function get_users(): array
    {
        $data = $this->db->table("users")->get();
        $users = [];
        foreach ($data as $row){
            $users[] = $this->makeUserEntity($row);
        }
        return $users;
    }

    /**
     * @param UserEntity $user
     */
    public function store(UserEntity $user)
    {
        $data = $this->getDataForInsert($user);
        $this->db->table("users")->insert(
            $data
        );
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
}
