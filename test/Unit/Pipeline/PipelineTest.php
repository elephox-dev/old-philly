<?php
declare(strict_types=1);

namespace test\Philly\Unit\Pipeline;

use Philly\Container\UnacceptableTypeException;
use Philly\Pipeline\Pipeline;
use PHPUnit\Framework\TestCase;
use stdClass;
use test\Philly\TestPipe;

/**
 * Class PipelineTest
 */
class PipelineTest extends TestCase
{
    public function testInvalidType()
    {
        $pipeline = new Pipeline();

        $this->expectException(UnacceptableTypeException::class);

        $pipeline["test"] = new stdClass();
    }

    public function testCorrectType()
    {
        $pipeline = new Pipeline();

        $instance = new TestPipe();
        $pipeline[TestPipe::class] = $instance;

        static::assertContains(TestPipe::class, $pipeline->getKeys());
        static::assertTrue($pipeline[TestPipe::class] === $instance);
    }
}
