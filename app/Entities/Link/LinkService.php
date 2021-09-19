<?php

namespace App\Entities\Link;

class LinkService
{
    /**
     * @var LinkStorage
     */
    private $linkStorage;

    /**
     * @param LinkStorage $linkStorage
     */
    public function __construct(LinkStorage $linkStorage)
    {
        $this->linkStorage = $linkStorage;
    }

    /**
     * @return LinkEntity[]
     */
    public function getLinks(int $user_id): array
    {
        return $this->linkStorage->getLinks($user_id);
    }

    /**
     * @param LinkEntity $link
     */
    public function storeLink(LinkEntity $link)
    {
        $this->linkStorage->store($link);
    }
}
