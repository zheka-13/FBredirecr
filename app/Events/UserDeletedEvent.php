<?php

namespace App\Events;

use App\Entities\User\UserEntity;

class UserDeletedEvent extends Event
{
    /**
     * @var UserEntity
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param UserEntity $user
     */
    public function __construct(UserEntity $user)
    {
        //
        $this->user = $user;
    }

    public function getUser(): UserEntity
    {
        return  $this->user;
    }
}
