<?php

declare(strict_types = 1);

namespace App\HttpClient;

/**
 * Class GuzzleHttpClient
 *
 * @package App\HttpClient
 */
class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @param string $url
     * @param string $method
     *
     * @return array|null
     */
    public function request(string $url, string $method): ?array
    {
        // TODO: Implement main logic.
        return null;
    }
}
