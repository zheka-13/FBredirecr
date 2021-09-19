<?php

namespace App\Entities\User;

use App\Entities\User\Exceptions\UserEntityException;

class UserEntity
{
    /**
     * @var int
     */
    private $id = 0;
    /**
     * @var string
     */
    private $name = "";
    /**
     * @var string
     */
    private $password = "";
    /**
     * @var string
     */
    private $email = "";
    /**
     * @var bool
     */
    private $is_admin = false;

    /**
     * @param string $email
     * @throws UserEntityException
     */
    public function __construct(string $email)
    {
        if (empty($email)) {
            throw  new UserEntityException(
                "User email cannot be empty"
            );
        }
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isIsAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @param int $id
     * @return UserEntity
     */
    public function setId(int $id): UserEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return UserEntity
     */
    public function setName(string $name): UserEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $password
     * @return UserEntity
     */
    public function setPassword(string $password): UserEntity
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param bool $is_admin
     * @return UserEntity
     */
    public function setIsAdmin(bool $is_admin): UserEntity
    {
        $this->is_admin = $is_admin;
        return $this;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "is_admin" => $this->is_admin
        ];
    }

}
