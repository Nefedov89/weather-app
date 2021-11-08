<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\CallerInvalidResponseCodeException;
use App\Exceptions\CallerUnexpectedResponseFormatException;
use App\HttpClient\CurlHttpClient;
use App\HttpClient\HttpClientInterface;
use Illuminate\Support\Arr;
use Exception;

use function is_array;
use function ucfirst;
use function intval;

/**
 * Class Caller
 *
 * @package App
 */
class Caller
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var array
     */
    private $configs;

    /**
     * Caller constructor.
     */
    public function __construct()
    {
        // Default http client, can be set with setHttpClient method.
        // It should be called before execute method.
        $this->httpClient = new CurlHttpClient();

        $this->configs = require './config/app.php';
    }

    /**
     * @param HttpClientInterface $httpClient
     *
     * @return Caller
     */
    public function setHttpClient(HttpClientInterface $httpClient): Caller
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return string
     *
     * @throws Exception
     */
    public function execute(string $city): string
    {
        $url = $this->buildRequestUrl($city);
        $response = $this->httpClient->request($url);

        if (!$response || !is_array($response)) {
            throw new CallerUnexpectedResponseFormatException();
        }

        $response_code = Arr::get($response, 'cod');

        if ($response_code !== 200) {
            $error_message = ucfirst(
                Arr::get($response, 'message', '')
            );

            throw new CallerInvalidResponseCodeException($error_message);
        }

        return $this->buildReadableAnswer($response);
    }

    /**
     * @param string $city
     *
     * @return string
     */
    private function buildRequestUrl(string $city): string
    {
        list($base_url, $api_key, $units) = [
            Arr::get($this->configs, 'weather_api_url', ''),
            Arr::get($this->configs, 'api_key', ''),
            Arr::get($this->configs, 'units', ''),
        ];

        return "{$base_url}?q={$city}&appid={$api_key}&units={$units}";
    }

    /**
     * @param array $response
     *
     * @return string
     *
     * @throws Exception
     */
    private function buildReadableAnswer(array $response): string
    {
        $answer = '';

        $weather_text_info = Arr::first(Arr::get($response, 'weather'));

        if ($weather_text_info) {
            $answer .= ucfirst(
                Arr::get($weather_text_info, 'description', '')
            );
        }

        $weather_numbers_info = Arr::get($response, 'main');

        if ($weather_numbers_info) {
            $temp_num = intval(Arr::get($weather_numbers_info, 'temp'));
            $temp_unit = Arr::get(
                $this->configs,
                "units_temp_map.{$this->configs['units']}"
            );
            $answer .= ", {$temp_num} degrees {$temp_unit}";
        }

        return $answer;
    }
}
