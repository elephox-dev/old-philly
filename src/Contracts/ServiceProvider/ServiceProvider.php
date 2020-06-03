<?php
declare(strict_types=1);

namespace Philly\Contracts\ServiceProvider;


/**
 * Interface ServiceProvider.
 */
interface ServiceProvider
{
	/**
	 * @return bool Whether the service provider was already registered.
	 */
	public function isRegistered(): bool;

	/**
	 * Gets called from the service container upon service registration. Do every action and initialization your service
	 * needs to function without accessing the service container.
	 */
	public function onRegistered(): void;

	/**
	 * @return bool Whether the service provider was already booted.
	 */
	public function isBooted(): bool;

	/**
	 * Gets called after every service was registered.
	 */
	public function onBooted(): void;
}
