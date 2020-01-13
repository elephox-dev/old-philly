<?php
declare(strict_types=1);

namespace Philly\Contracts\Routing;

use Philly\Contracts\App;
use Philly\Contracts\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface LinkerChain
 */
interface LinkerChain extends Container
{
    /**
     * @param App $app
     * @param Request $request
     * @return Response
     */
    function pass(App $app, Request $request): Response;
}
