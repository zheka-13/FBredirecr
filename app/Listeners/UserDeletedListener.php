<?php

namespace App\Listeners;

use App\Entities\Link\LinksFileStorage;
use App\Events\UserDeletedEvent;

class UserDeletedListener
{
    /**
     * @var LinksFileStorage
     */
    private $linksFileStorage;

    /**
     * Create the event listener.
     *
     * @param LinksFileStorage $linksFileStorage
     */
    public function __construct(LinksFileStorage $linksFileStorage)
    {
        //
        $this->linksFileStorage = $linksFileStorage;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(UserDeletedEvent $event)
    {
        $this->linksFileStorage->deleteUserFolder($event->getUser()->getId());
    }
}
