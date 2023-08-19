<?php

namespace App\Http\Controllers;


use App\Services\HashHmacService;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     * @throws ValidationException
     */
    public function hash_hmac(Request $request): JsonResponse
    {
        $this->validate($request, [
            "data" => "filled|required",
            "key" => "filled|required"
        ]);
        $algo = $request->input("algo") ?? "";
        $data = $request->input("data") ?? "";
        $key = $request->input("key") ?? "";
        return new JsonResponse([
            "hash" => $this->hashHmacService->getHashHmac($algo, $data, $key)
        ]);
    }


}
