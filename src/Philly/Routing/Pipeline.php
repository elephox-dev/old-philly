<?php
declare(strict_types=1);

namespace Philly\Routing;

use Exception;
use Philly\Container\Container;
use Philly\Contracts\App;
use Philly\Contracts\Routing\Pipe;
use Philly\Contracts\Routing\Pipeline as PipelineContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Pipeline
 */
class Pipeline extends Container implements PipelineContract
{
    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof Pipe;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    function pass(App $app, Request $request): JsonResponse
    {
        // TODO: implement pass method
    }
}
