<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Exceptions\ArgumentParserException;

/**
 * Class ArgumentParserTest
 */
class ArgumentParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testAbsenceOfCityArgument(): void
    {
        $appended_empty_args = ['', ' ', ' -c', ' --city', ' -test', ' --test'];

        foreach ($appended_empty_args as $arg) {
            $output = exec("php console.php{$arg}");
            $this->assertEquals($output, ArgumentParserException::DEFAULT_ERROR_MESSAGE);
        }
    }
}
