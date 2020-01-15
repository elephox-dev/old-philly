<?php
declare(strict_types=1);

namespace test\Philly\Unit\Routing;

use Closure;
use Philly\Contracts\App;
use Philly\Contracts\Routing\Pipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestPipe
 */
class TestPipe implements Pipe
{
    /**
     * @inheritDoc
     */
    function handle(App $app, Request $request, Closure $next): Response
    {
        return $next($app, $request);
    }
}
