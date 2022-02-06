<?php

namespace App\Http\Controllers\User;

use App\Entities\Link\Exceptions\LinkNotFoundException;
use App\Entities\Link\LinkEntity;
use App\Entities\Link\LinkService;
use App\Entities\Link\LinksFileStorage;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
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
    public function index(Request $request): View
    {
        if ($request->filled("sort")){
            $this->linkService->setSorting($request->input('sort'));
        }
        Paginator::useBootstrap();
        $links = $this->linkService->getLinksWithPaginator(app('auth')->user()->id);
        return view('user.links.list', ['title' => __('User Links'), "links" => $links]);
    }

    public function create(): View
    {
        return view('user.links.create', ['title' => __('Create Link')]);
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
        } catch (ValidationException $e) {
            $errors = json_decode($e->getResponse()->getContent(), true);
            return view('user.links.create', ['title' => __('Create Link')])->with("errors", $errors);
        }
        $link = new LinkEntity(0, $request->user()->id);
        $this->fillLinkEntityFromRequest($link, $request);
        $this->linkService->storeLink($link);
        return redirect(route('user.links'));
    }

    /**
     * @param Request $request
     * @param int $link_id
     * @return RedirectResponse|View
     */
    public function store_picture(Request $request, int $link_id)
    {
        $title = __('Edit Picture');
        $file = $request->file('picture');

        try {
            $link = $this->linkService->getLink($link_id, $request->user()->id);
        } catch (LinkNotFoundException $e) {
            return view('error', ['title' => 'Error', "error" => __("Link not found")]);
        }
        if (empty($file)){
            return view('user.links.edit_picture', ['title' => $title, "link" => $link]);
        }
        if (!in_array($file->getClientOriginalExtension(), LinksFileStorage::ALLOWED_EXTENSIONS)) {
            $errors = [
                'file' => [
                    __("This is not a picture. Forbidden file type")." ." . $file->getClientOriginalExtension().". "
                    .__("Allowed extension are").": ".implode(", ", LinksFileStorage::ALLOWED_EXTENSIONS)
                ]
            ];
            return view('user.links.edit_picture', ['title' => $title, "link" => $link, "errors" => $errors]);
        }
        if ($file->getSize() > LinksFileStorage::MAX_FILE_SIZE) {
            $errors = [
                'file' => [
                    "The size of the picture is more than". (LinksFileStorage::MAX_FILE_SIZE/1000000). " Mb"
                ]
            ];
            return view('user.links.edit_picture', ['title' => $title, "link" => $link, "errors" => $errors]);
        }
        $this->linkService->uploadLinkFile($link, $file);
        return redirect(route('user.links.edit_picture', ["link_id" => $link_id]));
    }

    /**
     * @param Request $request
     * @param $link_id
     * @return View
     */
    public function edit_picture(Request $request, $link_id): View
    {
        try {
            $link = $this->linkService->getLink($link_id, $request->user()->id);
            return view('user.links.edit_picture', ['title' => __('Edit Picture'), "link" => $link]);
        } catch (LinkNotFoundException $e) {
            return view('error', ['title' => __('Error'), "error" => __("Link not found")]);
        }
    }



    /**
     * @param Request $request
     * @param int $link_id
     * @return RedirectResponse
     * @throws LinkNotFoundException
     */
    public function delete(Request $request, int $link_id): RedirectResponse
    {
        $this->linkService->delete($link_id, $request->user()->id);
        return redirect(route('user.links'));
    }

    /**
     * @param int $link_id
     * @param Request $request
     * @return View
     */
    public function edit(int $link_id, Request $request): View
    {
        try {
            $link = $this->linkService->getLink($link_id, $request->user()->id);
            return view('user.links.edit', ['title' => __('Edit'), "link" => $link]);
        } catch (LinkNotFoundException $e) {
            return view('error', ['title' => __('Error'), "error" => __("Link not found")]);
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
        } catch (ValidationException $e) {
            $errors = json_decode($e->getResponse()->getContent(), true);
            return view('user.links.edit', ['title' => __('Edit Link')])->with("errors", $errors);
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
