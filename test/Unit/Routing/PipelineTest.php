<?php
declare(strict_types=1);

namespace test\Philly\Unit\Routing;

use Philly\Container\UnacceptableTypeException;
use Philly\Routing\Pipeline;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class PipelineTest
 */
class PipelineTest extends TestCase
{
    public function testInvalidType()
    {
        $linkerChain = new Pipeline();

        $this->expectException(UnacceptableTypeException::class);

        $linkerChain["test"] = new stdClass();
    }

    public function testCorrectType()
    {
        $linkerChain = new Pipeline();

        $instance = new TestPipe();
        $linkerChain[TestPipe::class] = $instance;

        static::assertContains(TestPipe::class, $linkerChain->getKeys());
        static::assertTrue($linkerChain[TestPipe::class] === $instance);
    }
}
