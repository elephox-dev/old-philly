<?php
declare(strict_types=1);

namespace Philly;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        // bind this app instance to its own class
        $this[App::class] = $this;
    }

    /**
     * @inheritDoc
     */
    function handle(Request $request): Response
    {
        $this[Request::class] = $request;
    }
}
