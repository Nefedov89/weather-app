<?php

declare(strict_types = 1);

use App\Caller;
use App\Exceptions\CallerInvalidResponseCodeException;
use PHPUnit\Framework\TestCase;

/**
 * Class CallerTest
 */
class CallerTest extends TestCase
{
    public const FAKE_CITY = 'Lorem ipsum';

    public const REAL_CITY = 'Berlin';

    /**
     * @return void
     *
     * @throws Exception
     */
    public function testExistingCity(): void
    {
        $result = (new Caller)->execute(self::REAL_CITY);

        $this->assertIsString($result);
    }

    /**
     * @return void
     *
     * @throws Exception
     */
    public function testNotExistingCity(): void
    {
        $this->expectException(CallerInvalidResponseCodeException::class);

        (new Caller)->execute(self::FAKE_CITY);
    }
}
