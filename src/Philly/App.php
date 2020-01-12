<?php
declare(strict_types=1);

namespace Philly;

/**
 * Class App
 */
class App extends Container\BindingContainer implements Contracts\App
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        // bind the class instance to its class
        $this[App::class] = $this;
    }
}
