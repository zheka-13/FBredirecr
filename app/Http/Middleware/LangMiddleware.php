<?php

namespace App\Http\Middleware;

use App\Entities\User\UserService;
use App\Enums\LanguagesEnum;
use Closure;
use Illuminate\Http\Request;

class LangMiddleware
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = LanguagesEnum::DEFAULT_LANGUAGE;
        if (!empty($request->user()->lang)) {
            $locale = $request->user()->lang;
        }
        $request_lang = $request->input('lang');
        if (!empty($request_lang) && in_array($request_lang, LanguagesEnum::ALL_LANGUAGES) && $request_lang != $locale) {
            $this->userService->setUserLang($request->user()->id, $request_lang);
            $locale = $request_lang;
        }
        $translator = app('translator');
        $translator->setFallback(LanguagesEnum::DEFAULT_LANGUAGE);
        $translator->setLocale($locale);
        return $next($request);
    }
}
