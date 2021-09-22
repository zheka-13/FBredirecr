<?php

namespace App\Entities\Link;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use Illuminate\Database\DatabaseManager;
use stdClass;

class LinkStorage
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
     * @param int $user_id
     * @return LinkEntity[]
     */
    public function getLinks(int $user_id): array
    {
        $data = $this->db->table("links")
            ->where("user_id", "=", $user_id)
            ->get();
        $links = [];
        foreach ($data as $row){
            $links[] = $this->makeLinkEntity($row);
        }
        return $links;
    }

    /**
     * @param int $user_id
     * @param int $link_id
     * @return LinkEntity
     * @throws LinkNotFoundException
     */
    public function getLink(int $link_id, int $user_id): LinkEntity
    {
        $data = $this->db->table("links")
            ->where("id", "=", $link_id)
            ->where("user_id", "=", $user_id)
            ->first();
        if (empty($data)){
            throw new LinkNotFoundException();
        }
        return $this->makeLinkEntity($data);
    }

    /**
     * @param string $hash
     * @return LinkEntity
     * @throws LinkNotFoundException
     */
    public function getLinkByHash(string $hash): LinkEntity
    {
        $data = $this->db->table("links")
            ->where("hash", "=", $hash)
            ->first();
        if (empty($data)){
            throw new LinkNotFoundException();
        }
        return $this->makeLinkEntity($data);
    }

    /**
     * @param LinkEntity $link
     */
    public function store(LinkEntity $link)
    {
        $data = $this->getDataForInsert($link);
        $this->db->table("links")->insert($data);
    }

    /**
     * @param LinkEntity $link
     */
    public function update(LinkEntity $link)
    {
        $data = $this->getDataForUpdate($link);
        $this->db
            ->table("links")
            ->where("id", "=", $link->getId())
            ->where("user_id", "=", $link->getUserId())
            ->update($data);
    }

    /**
     * @param LinkEntity $link
     */
    public function updateExtension(LinkEntity $link)
    {
        $this->db
            ->table("links")
            ->where("id", "=", $link->getId())
            ->where("user_id", "=", $link->getUserId())
            ->update([
                "extension" => $link->getExtension()
            ]);
    }

    /**
     * @param LinkEntity $link
     */
    public function delete(LinkEntity $link)
    {
        $this->db
            ->table("links")
            ->where("id", "=", $link->getId())
            ->where("user_id", "=", $link->getUserId())
            ->delete();
    }


    /**
     * @param stdClass $row
     * @return LinkEntity
     */
    private function makeLinkEntity(stdClass $row): LinkEntity
    {
        $link = new LinkEntity($row->id, $row->user_id);
        return $link
            ->setName($row->name ?? "")
            ->setLink($row->link ?? "")
            ->setHash($row->hash ?? "")
            ->setExtension($row->extension ?? "")
            ->setHeader($row->header ?? "");

    }

    /**
     * @param LinkEntity $link
     * @return array
     */
    private function getDataForInsert(LinkEntity $link): array
    {
        $data = [];
        $data['name'] = $link->getName();
        $data['link'] = $link->getLink();
        $data['header'] = $link->getHeader();
        $data['user_id'] = $link->getUserId();
        $data['hash'] = md5($link->getUserId().$link->getLink().microtime(true));
        return $data;
    }

    /**
     * @param LinkEntity $link
     * @return array
     */
    private function getDataForUpdate(LinkEntity $link): array
    {
        $data = [];
        $data['name'] = $link->getName();
        $data['link'] = $link->getLink();
        $data['header'] = $link->getHeader();
        return $data;
    }

}
