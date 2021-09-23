<?php

namespace App\Http\Controllers;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use App\Entities\Link\LinkService;
use App\Entities\Link\LinksFileStorage;
use App\Entities\Link\LinkStorage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class RedirectController extends Controller
{
    /**
     * @throws LinkNotFoundException
     */
    public function redirect(LinkStorage $linkStorage, string $hash)
    {
        $link = $linkStorage->getLinkByHash($hash);
        return view('fb', ['link' => $link, "host" => env('APP_URL')]);
    }

    /**
     * @param LinkService $linkService
     * @param LinksFileStorage $linksFileStorage
     * @param string $hash
     * @return string
     * @throws LinkNotFoundException
     * @throws FileNotFoundException
     */
    public function image(LinkService $linkService, LinksFileStorage $linksFileStorage, string $hash): string
    {
        $link = $linkService->getLinkByHash($hash);
        return $linksFileStorage->image($link);
    }
}
