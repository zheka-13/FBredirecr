<?php

namespace App\Entities\User;

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
}
