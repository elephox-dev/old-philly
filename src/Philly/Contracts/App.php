<?php
declare(strict_types=1);

namespace Philly\Contracts;

use Philly\Contracts\Container\BindingContainer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface App
 */
interface App extends BindingContainer
{
    /**
     * Handles a request in the app and returns a response.
     */
    function handle(Request $request): Response;
}
