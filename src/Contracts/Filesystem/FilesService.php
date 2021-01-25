<?php

declare(strict_types=1);

namespace Philly\Contracts\Filesystem;

use ArrayAccess;
use InvalidArgumentException;
use Philly\Contracts\Container\Container;
use Philly\Contracts\ServiceProvider\ServiceProvider;

/**
 * Interface FilesService.
 */
interface FilesService extends ServiceProvider, ArrayAccess
{
    /**
     * Returns all registered filesystems.
     *
     * @return Container A container with filesystems.
     */
    public function getAll(): Container;

    /**
     * Gets a specific filesystem by name.
     *
     * @param string $name The name of the filesystem.
     *
     * @return Filesystem The filesystem.
     *
     * @throws InvalidArgumentException If the name cannot be resolved to a filesystem.
     */
    public function get(string $name): Filesystem;

    /**
     * Adds a new filesystem under a specific name.
     *
     * @param string $name The name of the filesystem
     * @param Filesystem|string $filesystem The filesystem instance or the root of a filesystem.
     */
    public function add(string $name, Filesystem|string $filesystem): void;
}
