<?php
declare(strict_types=1);

namespace Philly\Contracts\Routing;


use Philly\Contracts\Container\BindingContainer;
use Philly\Routing\RoutingException;


/**
 * Interface RouteContainer.
 */
interface RouteContainer extends BindingContainer
{
	/**
	 * The default route to use if no other route matches.
	 *
	 * @param Route $fallbackRoute The route to use.
	 */
	public function setFallback(Route $fallbackRoute): void;

	/**
	 * The route which handles a request with the given uri.
	 *
	 * @param string $uri The uri to search a route for.
	 *
	 * @throws RoutingException If the uri cannot be routed.
	 *
	 * @return Route The route for handling the uri.
	 */
	public function getHandler(string $uri): Route;
}
