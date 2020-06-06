<?php

declare(strict_types=1);

namespace test\Philly\Unit;

use Philly\App;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testGetExceptionHandler()
    {
        $app = App::inst();

        $handler = $app->getExceptionHandler();

        static::assertInstanceOf(ExceptionHandlerContract::class, $handler);

        $handler2 = $app->getExceptionHandler();

        static::assertSame($handler, $handler2);
    }

    public function testGetServices()
    {
        $app = App::inst();

        $services = $app->getServices();

        static::assertInstanceOf(ServiceProviderContainerContract::class, $services);

        $services2 = $app->getServices();

        static::assertSame($services, $services2);
    }
}
