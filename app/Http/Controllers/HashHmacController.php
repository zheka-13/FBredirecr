<?php

namespace App\Http\Controllers;


use App\Services\HashHmacService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HashHmacController extends Controller
{
    /**
     * @var HashHmacService
     */
    private $hashHmacService;

    /**
     * @param HashHmacService $hashHmacService
     */
    public function __construct(HashHmacService $hashHmacService)
    {
        $this->hashHmacService = $hashHmacService;
    }


    /**
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function hash_hmac(Request $request): string
    {
        $this->validate($request, [
            "data" => "filled|required",
            "key" => "filled|required"
        ]);
        $algo = $request->input("algo") ?? "";
        $data = $request->input("data") ?? "";
        $key = $request->input("key") ?? "";
        return $this->hashHmacService->getHashHmac($algo, $data, $key);
    }


}
