<?php

declare(strict_types=1);

namespace test\Philly\Unit;

use Philly\Container\UnacceptableTypeException;
use Philly\Contracts\CLI\Commands\CommandCollection as CommandCollectionContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\ServiceProvider\ServiceProviderContainer as ServiceProviderContainerContract;
use PHPUnit\Framework\TestCase;
use test\Philly\TestApp;
use test\Philly\TestClass;

class AppTest extends TestCase
{
    public function testGetExceptionHandler()
    {
        try {
            $app = TestApp::inst();

            $handler = $app->getExceptionHandler();

            static::assertInstanceOf(ExceptionHandlerContract::class, $handler);

            $handler2 = $app->getExceptionHandler();

            static::assertSame($handler, $handler2);
        } finally {
            TestApp::reset();
        }
    }

    public function testGetServices()
    {
        try {
            $app = TestApp::inst();

            $services = $app->getServices();

            static::assertInstanceOf(ServiceProviderContainerContract::class, $services);

            $services2 = $app->getServices();

            static::assertSame($services, $services2);
        } finally {
            TestApp::reset();
        }
    }

    public function testGetCommands()
    {
        try {
            $app = TestApp::inst();

            $commands = $app->getCommands();

            static::assertInstanceOf(CommandCollectionContract::class, $commands);

            $commands2 = $app->getCommands();

            static::assertSame($commands, $commands2);
            static::assertGreaterThan(1, count($commands));
        } finally {
            TestApp::reset();
        }
    }

    public function testGetInvalidExceptionHandler()
    {
        try {
            $app = TestApp::inst();

            $app->bind(ExceptionHandlerContract::class, fn() => new TestClass(), true);

            static::expectException(UnacceptableTypeException::class);

            $app->getExceptionHandler();
        } finally {
            TestApp::reset();
        }
    }

    public function testGetInvalidServices()
    {
        try {
            $app = TestApp::inst();

            $app->bind(ServiceProviderContainerContract::class, fn() => new TestClass(), true);

            static::expectException(UnacceptableTypeException::class);

            $app->getServices();
        } finally {
            TestApp::reset();
        }
    }

    public function testGetInvalidCommands()
    {
        try {
            $app = TestApp::inst();

            $app->bind(CommandCollectionContract::class, fn() => new TestClass(), true);

            static::expectException(UnacceptableTypeException::class);

            $app->getCommands();
        } finally {
            TestApp::reset();
        }
    }
}
