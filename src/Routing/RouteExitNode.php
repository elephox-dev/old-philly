<?php

declare(strict_types=1);

namespace Philly\Routing;

use Philly\Contracts\Routing\Controller;
use Philly\Contracts\Routing\RouteExitNode as RouteExitNodeContract;
use ReflectionMethod;

/**
 * Class RouteExitNode.
 */
class RouteExitNode extends RouteNode implements RouteExitNodeContract
{
    /** @var Controller The controller which handles the request. */
    protected Controller $controller;

    /** @var ReflectionMethod The method in the controller which handles the request. */
    protected ReflectionMethod $method;

    /**
     * RouteExitNode constructor.
     *
     * @param string $pattern The pattern used to check whether this node handles a uri part.
     * @param Controller $controller The controller which handles the request.
     * @param ReflectionMethod $method The method in the controller which handles the request.
     * @param string|null $options The options to use when matching. Defaults to mb_regex_set_options().
     */
    public function __construct(string $pattern, Controller $controller, ReflectionMethod $method, ?string $options = null)
    {
        parent::__construct($pattern, $options);

        $this->controller = $controller;
        $this->method = $method;
    }

    /**
     * @inheritDoc
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @inheritDoc
     */
    public function getHandlerMethod(): ReflectionMethod
    {
        return $this->method;
    }
}
