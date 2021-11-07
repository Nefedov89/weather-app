<?php

declare(strict_types = 1);

namespace App\HttpClient;

/**
 * Interface HttpClientInterface
 *
 * @package App\HttpClient
 */
interface HttpClientInterface
{
    /**
     * @param string $url
     * @param string $method
     *
     * @return array|null
     */
    public function request(string $url, string $method): ?array;
}
