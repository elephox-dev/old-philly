<?php

declare(strict_types=1);

namespace test\Philly\Unit\Filesystem;

use Exception;
use Philly\Filesystem\FileExistsException;
use Philly\Filesystem\FileNotCreatedException;
use Philly\Filesystem\FileNotFoundException;
use Philly\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{
    public function testGetName()
    {
        $f = new Filesystem("test", "C:\\www\\test.com");

        static::assertSame("test", $f->getName());
    }

    public function testReal()
    {
        $f = new Filesystem("test", __DIR__);

        static::assertNotNull($f->real(basename(__FILE__)));
        static::assertNotNull($f->real(basename(__FILE__), false));
    }

    public function testExists()
    {
        $f = new Filesystem("test", __DIR__);

        static::assertTrue($f->exists(basename(__FILE__)));
    }

    /**
     * @throws FileNotCreatedException
     * @throws FileExistsException
     * @throws FileNotFoundException
     * @throws Exception
     */
    public function testContents()
    {
        $root = sys_get_temp_dir();
        $f = new Filesystem("temp", $root);
        $filename = "testfile" . random_int(0, 99);
        $nested_filename = "test/testfile" . random_int(0, 99);

        try {
            static::assertFalse($f->exists($filename));
            static::assertFalse($f->exists($nested_filename));

            static::assertTrue($f->putContents($filename, "This is some random test string"));
            static::assertTrue($f->putContents($nested_filename, "This is some random test string in a nested file"));

            static::assertTrue($f->exists($filename));
            static::assertTrue($f->exists($nested_filename));

            static::assertSame("This is some random test string", $f->getContents($filename));
            static::assertSame("This is some random test string in a nested file", $f->getContents($nested_filename));
        } finally {
            if (file_exists($root . DIRECTORY_SEPARATOR . $filename)) {
                unlink($root . DIRECTORY_SEPARATOR . $filename);
            }

            if (file_exists($root . DIRECTORY_SEPARATOR . $nested_filename)) {
                unlink($root . DIRECTORY_SEPARATOR . $nested_filename);
                rmdir(dirname($root . DIRECTORY_SEPARATOR . $nested_filename));
            }
        }

        try {
            $f->getContents($filename);

            // fail if we reach this point
            static::assertTrue(false);
        } catch (FileNotFoundException $fnfe) {
            static::assertEquals($root . DIRECTORY_SEPARATOR . $filename, $fnfe->getPath());
        }

        static::expectException(FileNotFoundException::class);

        $f->getContents($filename);
    }

    /**
     * @throws FileExistsException
     * @throws FileNotCreatedException
     * @throws FileNotFoundException
     */
    public function testOverwriteContents()
    {
        $root = sys_get_temp_dir();
        $f = new Filesystem("temp", $root);
        $filename = "testfile" . random_int(0, 99);

        $f->putContents($filename, "test1");

        $this->assertSame("test1", $f->getContents($filename));

        $f->putContents($filename, "test2", true);

        $this->assertSame("test2", $f->getContents($filename));

        try {
            $f->putContents($filename, "test3", false);
        } catch (FileExistsException $fee) {
            static::assertEquals($root . DIRECTORY_SEPARATOR . $filename, $fee->getPath());
        }

        try {
            $this->expectException(FileExistsException::class);

            $f->putContents($filename, "test3", false);
        } finally {
            $this->assertSame("test2", $f->getContents($filename));
        }
    }

    /**
     * @throws FileNotCreatedException
     * @throws FileExistsException
     * @throws Exception
     */
    public function testNoOverwriteContents()
    {
        $root = sys_get_temp_dir();
        $f = new Filesystem("temp", $root);
        $filename = "testfile" . random_int(0, 99);

        try {
            static::assertFalse($f->exists($filename));

            static::assertTrue($f->putContents($filename, "This is some random test string"));

            static::assertTrue($f->exists($filename));

            static::expectException(FileExistsException::class);

            $f->putContents($filename, "test", false);
        } finally {
            if (file_exists($root . DIRECTORY_SEPARATOR . $filename)) {
                unlink($root . DIRECTORY_SEPARATOR . $filename);
            }
        }
    }

    /**
     * @throws FileNotFoundException
     */
    public function testNotReal()
    {
        $f = new Filesystem("temp", sys_get_temp_dir());

        static::assertNull($f->real("non-existent-filename", false));

        static::expectException(FileNotFoundException::class);

        $f->real("non-existent-filename");
    }

    public function testGetRoot()
    {
        $f = new Filesystem("test", "C:\\www\\test.com");

        static::assertSame("C:\\www\\test.com" . DIRECTORY_SEPARATOR, $f->getRoot());
    }

    /**
     * @throws FileExistsException
     */
    public function testNoFileCreated()
    {
        $f = new Filesystem("temp", sys_get_temp_dir());

        static::expectException(FileNotCreatedException::class);

        $f->putContents("", "test");
    }
}
