<?php

namespace App\Entities\Link;

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
     * @param LinkEntity $link
     */
    public function store(LinkEntity $link)
    {
        $data = $this->getDataForInsert($link);
        $this->db->table("links")->insert($data);
    }

    /**
     * @param stdClass $row
     * @return LinkEntity
     */
    private function makeLinkEntity(stdClass $row): LinkEntity
    {
        $link = new LinkEntity($row->id, $row->user_id);
        return $link
            ->setName($row->name)
            ->setLink($row->link)
            ->setHash($row->hash)
            ->setHeader($row->header);

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

}
