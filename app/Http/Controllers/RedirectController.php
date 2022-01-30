<?php

namespace App\Http\Controllers;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use App\Entities\Link\LinkService;
use App\Entities\Link\LinksFileStorage;
use App\Entities\Link\LinkStorage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;

class RedirectController extends Controller
{
    /**
     * @throws LinkNotFoundException
     */
    public function redirect(LinkStorage $linkStorage, string $hash)
    {
        $link = $linkStorage->getLinkByHash($hash);
        $linkStorage->logRedirect($link);
        return view('fb', ['link' => $link, "host" => env('APP_URL')]);
    }

    /**
     * @param LinkService $linkService
     * @param LinksFileStorage $linksFileStorage
     * @param string $hash
     * @return Response
     * @throws FileNotFoundException
     * @throws LinkNotFoundException
     */
    public function image(LinkService $linkService, LinksFileStorage $linksFileStorage, string $hash): Response
    {
        $link = $linkService->getLinkByHash($hash);
        return new Response($linksFileStorage->image($link), 200, [
            "Content-Type" => "image/jpeg"
        ]);
    }
}
