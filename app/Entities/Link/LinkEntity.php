<?php

namespace App\Entities\Link;

class LinkEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $name = "";

    /**
     * @var string
     */
    private $link = "";

    /**
     * @var string
     */
    private $hash = "";

    /**
     * @var string
     */
    private $header = "";

    /**
     * @var string
     */
    private $extension = "";

    /**
     * @var bool
     */
    private $has_picture = false;

    /**
     * @param int $id
     * @param int $user_id
     */
    public function __construct(int $id, int $user_id)
    {
        $this->user_id = $user_id;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getPictureUrl(): string
    {
        return '/user/img/'.$this->hash.".".$this->extension;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $name
     * @return LinkEntity
     */
    public function setName(string $name): LinkEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $link
     * @return LinkEntity
     */
    public function setLink(string $link): LinkEntity
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param string $hash
     * @return LinkEntity
     */
    public function setHash(string $hash): LinkEntity
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @param string $header
     * @return LinkEntity
     */
    public function setHeader(string $header): LinkEntity
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param string $extension
     * @return LinkEntity
     */
    public function setExtension(string $extension): LinkEntity
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @param bool $has_picture
     * @return LinkEntity
     */
    public function setHasPicture(bool $has_picture): LinkEntity
    {
        $this->has_picture = $has_picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinkName(): string
    {
        return substr($this->link, 0, 20).(strlen($this->link)>20 ? "..." : "");
    }

    /**
     * @return string
     */
    public function getFBLink(): string
    {
        return route('redirect', ['hash' => $this->hash]);
    }

    /**
     * @return string
     */
    public function getSubstrHeader(): string
    {
        return mb_substr($this->header, 0, 20).(mb_strlen($this->header)>20 ? "..." : "");
    }

    /**
     * @return bool
     */
    public function hasPicture():bool
    {
        return $this->has_picture;
    }

}
