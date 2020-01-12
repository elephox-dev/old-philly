<?php
declare(strict_types=1);

namespace test\Philly\Unit\Routing;

use Philly\Container\UnacceptableTypeException;
use Philly\Routing\LinkerChain;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class LinkerChainTest
 */
class LinkerChainTest extends TestCase
{
    public function testInvalidType()
    {
        $linkerChain = new LinkerChain();

        $this->expectException(UnacceptableTypeException::class);

        $linkerChain["test"] = new stdClass();
    }

    public function testCorrectType()
    {
        $linkerChain = new LinkerChain();

        $instance = new TestLinker();
        $linkerChain[TestLinker::class] = $instance;

        static::assertContains(TestLinker::class, $linkerChain->getKeys());
        static::assertTrue($linkerChain[TestLinker::class] === $instance);
    }
}
