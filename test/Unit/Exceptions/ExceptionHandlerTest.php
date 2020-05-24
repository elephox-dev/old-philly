<?php
declare(strict_types=1);

namespace test\Philly\Unit\Exceptions;


use InvalidArgumentException;
use Philly\Exceptions\ExceptionHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class ExceptionHandlerTest
 */
class ExceptionHandlerTest extends TestCase
{
	public function testHandle()
	{
		$handler = new ExceptionHandler();
		$exception = new InvalidArgumentException("test");

		$response = $handler->handle($exception);

		static::assertTrue($response->getStatusCode() >= 500);

		static::assertEquals("application/json", $response->headers->get('Content-Type'));

		$content = $response->getContent();
		$decoded = json_decode($content, true);

		static::assertIsArray($decoded);
	}
}
