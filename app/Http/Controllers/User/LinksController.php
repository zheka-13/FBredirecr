<?php

namespace App\Http\Controllers\User;

use App\Entities\Link\Exceptions\LinkNotFoundException;
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
        return view('user.links.list', ['title' => 'User Links', "links" => $links]);
    }

    public function create(): View
    {
        return view('user.links.create', ['title' => 'Create Link']);
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
        $link = new LinkEntity(0, $request->user()->id);
        $this->fillLinkEntityFromRequest($link, $request);
        $this->linkService->storeLink($link);
        return redirect(route('user.links'));
    }

    /**
     * @param int $link_id
     * @param Request $request
     * @return View
     */
    public function edit(int $link_id, Request $request): View
    {
        try{
            $link = $this->linkService->getLink($link_id, $request->user()->id);
            return view('user.links.edit', ['title' => 'Edit', "link" => $link]);
        }
        catch(LinkNotFoundException $e){
            return view('error', ['title' => 'Error', "error" => "Link not found"]);
        }
    }

    /**
     * @param Request $request
     * @param int $link_id
     * @return RedirectResponse|View
     * @throws LinkNotFoundException
     */
    public function update(Request $request, int $link_id)
    {
        try {
            $this->validate($request, [
                "link" => "string|required",
            ]);
        }
        catch (ValidationException $e) {
            $errors = json_decode($e->getResponse()->getContent(), true);
            return view('user.links.edit', ['title' => 'Edit Link'])->with("errors", $errors);
        }
        $link = $this->linkService->getLink($link_id, $request->user()->id);
        $this->fillLinkEntityFromRequest($link, $request);

        $this->linkService->updateLink($link);
        return redirect(route('user.links'));
    }

    /**
     * @param LinkEntity $link
     * @param Request $request
     */
    private function fillLinkEntityFromRequest(LinkEntity $link, Request $request)
    {
        $link
            ->setLink($request->input("link", "") ?? "")
            ->setHeader($request->input('header', "") ?? "")
            ->setName($request->input("name", "") ?? "");
    }

}
