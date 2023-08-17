<?php

namespace App\Services;

class HashHmacService
{
    private const DEFAULT_ALGO = "md5";
    public function getHashHmac($algo, $data, $key): string
    {
        $algo = !empty($algo) ? $algo : self::DEFAULT_ALGO;
        return hash_hmac($algo, $data, $key);
    }
}
