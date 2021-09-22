<?php

namespace App\Entities\Link;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use Illuminate\Http\UploadedFile;

class LinkService
{
    /**
     * @var LinkStorage
     */
    private $linkStorage;
    /**
     * @var LinksFileStorage
     */
    private $linksFileStorage;

    /**
     * @param LinkStorage $linkStorage
     * @param LinksFileStorage $linksFileStorage
     */
    public function __construct(LinkStorage $linkStorage, LinksFileStorage $linksFileStorage)
    {
        $this->linkStorage = $linkStorage;
        $this->linksFileStorage = $linksFileStorage;
    }

    /**
     * @return LinkEntity[]
     */
    public function getLinks(int $user_id): array
    {
        $links = $this->linkStorage->getLinks($user_id);
        foreach ($links as $link){
            $link->setHasPicture($this->linksFileStorage->pictureExists($link));
        }
        return  $links;
    }

    /**
     * @param LinkEntity $link
     */
    public function storeLink(LinkEntity $link)
    {
        $this->linkStorage->store($link);
    }

    /**
     * @param int $user_id
     * @param int $link_id
     * @return LinkEntity
     * @throws LinkNotFoundException
     */
    public function getLink(int $link_id, int $user_id): LinkEntity
    {
        return $this->linkStorage->getLink($link_id, $user_id);
    }

    /**
     * @param LinkEntity $link
     */
    public function updateLink(LinkEntity $link)
    {
        $this->linkStorage->update($link);
    }

    /**
     * @param LinkEntity $link
     * @param UploadedFile $file
     */
    public function uploadLinkFile(LinkEntity $link, UploadedFile $file)
    {
        $this->linksFileStorage->deletePicture($link);
        $link->setExtension($file->getClientOriginalExtension());
        $this->linksFileStorage->storeFile($link, $file);
        $this->linkStorage->updateExtension($link);
    }

    /**
     * @param int $link_id
     * @param int $user_id
     * @throws LinkNotFoundException
     */
    public function delete(int $link_id, int $user_id)
    {
        $link = $this->getLink($link_id, $user_id);
        $this->linksFileStorage->deletePicture($link);
        $this->linkStorage->delete($link);

    }
}
