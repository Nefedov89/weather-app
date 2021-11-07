<?php

declare(strict_types = 1);

namespace App\HttpClient;

use function json_decode;
use function strtoupper;

/**
 * Class CurlHttpClient
 *
 * @package App\HttpClient
 */
class CurlHttpClient implements HttpClientInterface
{
    /**
     * @param string $url
     * @param string $method
     *
     * @return array|null
     */
    public function request(string $url, string $method = 'get'): ?array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: Weather-App']);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output !== false ? json_decode($output, true) : null;
    }
}
