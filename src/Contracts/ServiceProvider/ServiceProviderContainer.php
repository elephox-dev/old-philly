<?php
declare(strict_types=1);

namespace Philly\Contracts\ServiceProvider;


use Philly\Contracts\Container\BindingContainer;

/**
 * Interface ServiceProviderContainer.
 */
interface ServiceProviderContainer extends BindingContainer
{
	/**
	 * Boots all registered services.
	 */
	public function boot(): void;
}
