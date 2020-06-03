<?php
declare(strict_types=1);

namespace test\Philly\Unit\ServiceProvider;


use Philly\ServiceProvider\AlreadyBootedException;
use Philly\ServiceProvider\AlreadyRegisteredException;
use Philly\ServiceProvider\NotRegisteredException;
use PHPUnit\Framework\TestCase;
use test\Philly\TestServiceProvider;

class ServiceProviderTest extends TestCase
{
	public function testDoubleRegistration()
	{
		$serviceProvider = new TestServiceProvider();

		static::assertFalse($serviceProvider->isRegistered());

		$serviceProvider->onRegistered();

		static::assertTrue($serviceProvider->isRegistered());

		static::expectException(AlreadyRegisteredException::class);
		$serviceProvider->onRegistered();
	}

	public function testOnBootedNotRegistered()
	{
		$serviceProvider = new TestServiceProvider();

		static::assertFalse($serviceProvider->isBooted());
		static::assertFalse($serviceProvider->isRegistered());

		static::expectException(NotRegisteredException::class);
		$serviceProvider->onBooted();
	}

	public function testDoubleBooted()
	{
		$serviceProvider = new TestServiceProvider();

		static::assertFalse($serviceProvider->isBooted());
		static::assertFalse($serviceProvider->isRegistered());

		$serviceProvider->onRegistered();

		static::assertTrue($serviceProvider->isRegistered());

		$serviceProvider->onBooted();

		static::assertTrue($serviceProvider->isBooted());

		static::expectException(AlreadyBootedException::class);
		$serviceProvider->onBooted();
	}
}
