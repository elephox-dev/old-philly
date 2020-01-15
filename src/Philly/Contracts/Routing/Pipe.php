<?php
declare(strict_types=1);

namespace Philly\Contracts\Routing;

use Closure;
use Philly\Contracts\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface Pipe
 */
interface Pipe
{
    /**
     * Handle a request and modify it.
     */
    function handle(App $app, Request $request, Closure $next);
}