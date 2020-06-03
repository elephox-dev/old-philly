<?php
declare(strict_types=1);

namespace Philly\Contracts\Container;

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
