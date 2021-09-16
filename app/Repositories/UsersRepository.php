<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\DatabaseManager;

class UsersRepository
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
     * @param string $password
     * @return User|null
     */
    public function loginUser(string $email, string $password): ?User
    {
        $user = $this->db->table("users")
            ->where("email", "=", $email)
            ->where("password", "=", $password)
            ->first();
        if (empty($user)){
            return null;
        }
        return new User((array)$user);
    }
}
