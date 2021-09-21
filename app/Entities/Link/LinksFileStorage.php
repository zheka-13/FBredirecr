<?php

namespace App\Entities\Link;



class LinksFileStorage
{

    /**
     * @var `Filesystem
     */
    private $disk;

    public function __construct()
    {
        $this->disk = app('filesystem')->disk('links');
    }

    /**
     * @param int $user_id
     */
    public function deleteUserFolder(int $user_id)
    {
        $this->disk->delete("/".$user_id);
    }
}
