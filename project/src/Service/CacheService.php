<?php

namespace App\Service;

use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;

class CacheService
{
    public const CACHE_EXPIRATION_TIME = 3600;
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function get(string $key, callable $callback)
    {
        return $this->cache->get($key, $callback);
    }
}