<?php

declare(strict_types=1);

namespace Philly\Routing;

use Philly\Container\Collection;
use Philly\Contracts\Routing\RouteNode as RouteNodeContract;

/**
 * Class RouteNode.
 */
class RouteNode implements RouteNodeContract
{
    /** @var string The pattern to match uri parts against. */
    protected string $pattern;

    /** @var string The options to use when matching. */
    protected string $options;

    /** @var Collection All nodes which follow this one. */
    protected Collection $subNodes;

    /**
     * RouteNode constructor.
     *
     * @param string $pattern The pattern used to check whether this node handles a uri part.
     * @param string|null $options The options to use when matching. Defaults to mb_regex_set_options().
     * @param array|RouteNodeContract[] $nodes The sub-nodes for this node.
     */
    public function __construct(string $pattern, ?string $options = null, array ...$nodes)
    {
        $this->pattern = $pattern;
        $this->options = $options ?? mb_regex_set_options();
        $this->subNodes = new Collection($nodes);
    }

    /**
     * @inheritDoc
     */
    public function handles(string $uriPart): bool
    {
        return mb_ereg_match($this->pattern, $uriPart, $this->options);
    }

    /**
     * @inheritDoc
     */
    public function getNext(string $uriPart): ?RouteNodeContract
    {
        return $this->subNodes->first(fn (RouteNodeContract $node) => $node->handles($uriPart));
    }

    /**
     * @inheritDoc
     */
    public function addNode(RouteNodeContract $node): void
    {
        $this->subNodes->add($node);
    }
}
