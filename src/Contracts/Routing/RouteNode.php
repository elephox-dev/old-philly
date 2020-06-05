<?php
declare(strict_types=1);

namespace Philly\Contracts\Routing;


/**
 * Interface RouteNode.
 */
interface RouteNode
{
	/**
	 * Checks whether this route node handles a part of the uri.
	 *
	 * @param string $uriPart The part to check.
	 * @return bool Whether or not this node handles the given uri part.
	 */
	function handles(string $uriPart): bool;

	/**
	 * Get the next node for the given uri part.
	 *
	 * @param string $uriPart The uri part to filter for.
	 * @return self|null The next node or null if the uri part is not handled by this node.
	 */
	function getNext(string $uriPart): ?self;

	/**
	 * Add a sub-node to this node.
	 *
	 * @param RouteNode $node The node to add.
	 */
	function addNode(RouteNode $node): void;
}
