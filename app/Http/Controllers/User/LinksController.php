<?php

namespace App\Http\Controllers\User;

use App\Entities\Link\LinkEntity;
use App\Entities\Link\LinkService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LinksController extends Controller
{
    /**
     * @var LinkService
     */
    private $linkService;

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $links = $this->linkService->getLinks(app('auth')->user()->id);
        return view('links.list', ['title' => 'User Links', "links" => $links]);
    }

    public function create(): View
    {
        return view('links.create', ['title' => 'Create Link']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                "link" => "string|required",
            ]);
        }
        catch (ValidationException $e) {
            $errors = json_decode($e->getResponse()->getContent(), true);
            return view('user.links.create', ['title' => 'Create Link'])->with("errors", $errors);
        }
        $link = $this->makeLinkEntityFromRequest($request);
        $this->linkService->storeLink($link);
        return redirect(route('user.links'));
    }

    /**
     * @param Request $request
     * @return LinkEntity
     */
    private function makeLinkEntityFromRequest(Request $request): LinkEntity
    {
        $link = new LinkEntity(0, $request->user()->id);
        return $link
            ->setLink($request->input("link", "") ?? "")
            ->setHeader($request->input('header', "") ?? "")
            ->setName($request->input("name", "") ?? "");
    }

}
