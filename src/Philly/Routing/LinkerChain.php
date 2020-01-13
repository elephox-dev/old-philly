<?php
declare(strict_types=1);

namespace Philly\Routing;

use Exception;
use Philly\Container\Container;
use Philly\Contracts\App;
use Philly\Contracts\Routing\Linker;
use Philly\Contracts\Routing\LinkerChain as BaseLinkerChain;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LinkerChain
 */
class LinkerChain extends Container implements BaseLinkerChain
{
    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof Linker;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    function pass(App $app, Request $request): Response
    {

    }
}
