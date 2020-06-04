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
	/** @var RouteContract|null This is the fallback route used if no route matches. */
	protected ?RouteContract $fallbackRoute = null;

	/**
	 * @inheritDoc
	 */
	public function acceptsBinding($value): bool
	{
		return $value instanceof RouteContract;
	}
}
