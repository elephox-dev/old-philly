<?php
declare(strict_types=1);

namespace Philly\Routing;


use Philly\Container\BindingContainer;
use Philly\Contracts\Routing\Route as RouteContract;
use Philly\Contracts\Routing\RouteContainer as RouteContainerContract;

/**
 * Class RouteContainer.
 */
class RouteContainer extends BindingContainer implements RouteContainerContract
{
	/** @var RouteContract|null $fallbackRoute This is the fallback route used if no route matches. */
	protected ?RouteContract $fallbackRoute = null;

	/**
	 * @inheritDoc
	 */
	public function acceptsBinding($value): bool
	{
		return $value instanceof RouteContract;
	}

	/**
	 * @inheritDoc
	 */
	public function setFallback(RouteContract $fallbackRoute): void
	{
		$this->fallbackRoute = $fallbackRoute;
	}

	/**
	 * @inheritDoc
	 */
	public function getHandler(string $uri): RouteContract
	{
		if ($this->fallbackRoute == null)
			throw new RoutingException("Cannot route URI \"$uri\": no fallback defined");

		return $this->fallbackRoute;
	}
}
