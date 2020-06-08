<?php

declare(strict_types=1);

namespace Philly\Routing;

use Philly\Contracts\Routing\RouteExitNode as RouteExitNodeContract;
use Philly\Contracts\Routing\RouteNode as RouteNodeContract;
use Philly\Stack\Stack;

class Router
{
    protected RouteNodeContract $entryNode;

    protected ?RouteExitNodeContract $fallbackNode = null;

    public function __construct(string $entryNode = "")
    {
        $this->entryNode = new RouteNode($entryNode);
    }

    public function getEntryNode(): RouteNodeContract
    {
        return $this->entryNode;
    }

    public function setFallbackNode(RouteExitNodeContract $fallbackNode): void
    {
        $this->fallbackNode = $fallbackNode;
    }

    public function getExitNode(string $uri): ?RouteExitNodeContract
    {
        $routeStack = new Stack(preg_split("/\//", $uri));

        /** @var RouteExitNodeContract|null $currentNode */
        $currentNode = $this->entryNode;

        if ($routeStack->isEmpty()) {
            return $this->fallbackNode;
        }

        while (!($currentNode instanceof RouteExitNodeContract)) {
            $nextPart = $routeStack->pop();

            if ($currentNode === null) {
                return $this->fallbackNode;
            }

            $currentNode = $currentNode->getNext($nextPart);
        }

        return $currentNode;
    }
}
