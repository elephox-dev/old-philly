<?php

declare(strict_types=1);

namespace Filesystem;

use InvalidArgumentException;
use Philly\Filesystem\Filesystem;
use Philly\Filesystem\FilesystemContainer;
use PHPUnit\Framework\TestCase;

class FilesystemContainerTest extends TestCase
{
    public function testCopy()
    {
        $c = new FilesystemContainer();
        $c->put('test', new Filesystem("test", sys_get_temp_dir()));

        $c2 = $c->copy();

        $this->assertNotSame($c, $c2);
        $this->assertSameSize($c, $c2);
        $this->assertNotSame($c['test'], $c2['test']);
    }

    public function testNoShallowCopy()
    {
        $c = new FilesystemContainer();

        $this->expectException(InvalidArgumentException::class);

        $c->copy(deep: false);
    }
}
