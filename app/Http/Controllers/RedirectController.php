<?php

namespace App\Http\Controllers;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use App\Entities\Link\LinkStorage;

class RedirectController extends Controller
{
    /**
     * @throws LinkNotFoundException
     */
    public function redirect(LinkStorage $linkStorage, string $hash)
    {
        $link = $linkStorage->getLinkByHash($hash);
        return view('fb', ['link' => $link]);
    }
}
