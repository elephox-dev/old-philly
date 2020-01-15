<?php
declare(strict_types=1);

namespace Philly\Contracts\Routing;

use Philly\Contracts\App;
use Philly\Contracts\Container\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface LinkerChain
 */
interface Pipeline extends Container
{
    /**
     * @param App $app
     * @param Request $request
     * @return JsonResponse
     */
    public function pass(App $app, Request $request): JsonResponse;
}
