<?php

declare(strict_types = 1);

use App\ArgumentParser;
use App\Caller;

require __DIR__.'/vendor/autoload.php';

try {
    $response = (new Caller)->execute(ArgumentParser::getCity());

    print($response.PHP_EOL);
} catch (Exception $e) {
    echo $e->getMessage().PHP_EOL;
}
