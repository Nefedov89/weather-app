<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ArgumentParserException;
use Illuminate\Support\Arr;

use function getopt;

/**
 * Class ArgumentParser
 *
 * @package App
 */
class ArgumentParser
{
    /**
     * @return string
     *
     * @throws ArgumentParserException
     */
    public static function getCity(): string
    {
        $args = getopt('c:', ['city:']);
        $city = Arr::get($args, 'c') ?: Arr::get($args, 'city');

        if (!$city) {
            throw new ArgumentParserException();
        }

        return $city;
    }
}
