<?php

declare(strict_types=1);

namespace Philly\Contracts\CLI\Commands;

/**
 * Interface CommandArgumentCollection.
 */
interface CommandArgumentCollection extends CommandArgumentTemplateCollection
{
    /**
     * Gets the value of an argument by the specified key.
     *
     * @param string $key The key of the argument.
     * @param mixed|null $default The default value to return if the argument was not set.
     * @return mixed|null The value of the argument or the default value.
     */
    public function getValue(string $key, $default = null);
}
