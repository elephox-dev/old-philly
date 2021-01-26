<?php
declare(strict_types=1);

namespace Philly\Filesystem;

use Philly\Container\Container;
use Philly\Contracts\Container\Container as ContainerContract;
use Philly\Contracts\Filesystem\FilesService as FilesServiceContract;
use Philly\Contracts\Filesystem\Filesystem as FilesystemContract;
use Philly\ServiceProvider\ServiceProvider;
use ricardoboss\Console;

class FilesService extends ServiceProvider implements FilesServiceContract
{
    protected ContainerContract $storage;

    public function __construct()
    {
        $this->storage = new Container();
    }

    /**
     * @inheritDoc
     */
    public function onRegistered(): void
    {
        $this->add('philly-root', dirname(__DIR__, 2));

        parent::onRegistered();
    }

    /**
     * @inheritDoc
     */
    public function getAll(): ContainerContract
    {
        return $this->storage->copy();
    }

    /**
     * @inheritDoc
     */
    public function get(string $name): FilesystemContract
    {
        return $this->storage->offsetGet($name);
    }

    /**
     * @inheritDoc
     */
    public function add(string $name, string|FilesystemContract $filesystem): void
    {
        if ($filesystem instanceof FilesystemContract)
            $this->storage[$name] = $filesystem;
        else
            $this->storage[$name] = new Filesystem($name, $filesystem);

        Console::debug("Added filesystem '$name' with root '{$this->storage[$name]->getRoot()}'");
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return $this->storage->offsetExists($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->storage->offsetSet($offset, $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        $this->storage->offsetUnset($offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->storage->offsetGet($offset);
    }
}
