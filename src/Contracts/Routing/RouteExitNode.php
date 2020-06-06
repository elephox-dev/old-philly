<?php

declare(strict_types=1);

namespace Philly\Contracts\Routing;

use ReflectionMethod;

/**
 * Interface RouteExitNode.
 */
interface RouteExitNode extends RouteNode
{
    /**
     * @return Controller The controller which handles the request.
     */
    public function getController(): Controller;

    /**
     * @return ReflectionMethod The method which handles the request.
     */
    public function getHandlerMethod(): ReflectionMethod;
}
