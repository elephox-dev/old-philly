<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Philly\Collection\Collection;
use Philly\Container\FiltersTypes;
use Philly\Contracts\App;
use Philly\Contracts\Pipeline\Pipe as PipeContract;
use Philly\Contracts\Pipeline\Pipeline as PipelineContract;
use Philly\Contracts\Pipeline\PostPipe as PostPipeContract;
use Philly\Contracts\Pipeline\PrePipe as PrePipeContract;
use Philly\Contracts\Pipeline\Pump as PumpContract;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Pipeline
 */
class Pipeline extends Collection implements PipelineContract
{
    use FiltersTypes;

    /**
     * @inheritDoc
     */
    public function accepts($value): bool
    {
        return $value instanceof PipeContract;
    }

    /**
     * @inheritDoc
     */
    public function handle(App $app, Request $request): Response
    {
        $request = $this->handlePrePipes($app, $request);
        if ($request instanceof Response)
            return $request;

        $pump = $this->getPump($request);
        assert($pump != null, "No pump was found to handle the request!");

        $response = $pump->handle($app, $request);
        $response = $this->handlePostPipes($app, $response);

        return $response;
    }

    /**
     * @param App $app
     * @param Request $request
     * @return Request|Response
     */
    public function handlePrePipes(App $app, Request $request)
    {
        $prePipes = $this->getPrePipes();
        foreach ($prePipes as $pipe) {
            $output = $pipe->handle($app, $request);

            // check if we have to abort
            if (!$output->isSuccessful()) {
                $result = $output->getResult();

                assert($result instanceof Response, "Pipe output has invalid result!");

                return $result;
            }

            $result = $output->getResult();

            assert($result instanceof Request, "Pipe output has invalid result!");

            $request = $result;
        }

        return $request;
    }

    /**
     * @param App $app
     * @param Response $response
     * @return Response
     */
    public function handlePostPipes(App $app, Response $response): Response
    {
        $postPipes = $this->getPostPipes();
        foreach ($postPipes as $pipe) {
            $output = $pipe->handle($app, $response);
            $result = $output->getResult();

            assert($result instanceof Response, "Pipe output has invalid result!");

            // check if we have to abort
            if (!$output->isSuccessful()) {
                return $result;
            }

            $response = $result;
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return PumpContract
     */
    public function getPump(Request $request): PumpContract
    {
        return $this->getInstancesOf(PumpContract::class)
            ->first(function (PumpContract $pump) use ($request) {
                $pump->accepts($request);
            });
    }

    /**
     * @inheritDoc
     */
    public function addPre(PrePipeContract $pipe): void
    {
        $this->add($pipe);
    }

    /**
     * @inheritDoc
     */
    public function addPost(PostPipeContract $pipe): void
    {
        $this->add($pipe);
    }

    /**
     * @inheritDoc
     */
    public function addPump(PumpContract $pump): void
    {
        $this->add($pump);
    }

    /**
     * @return PrePipeContract[]
     */
    public function getPrePipes(): array
    {
        return $this->getInstancesOf(PrePipeContract::class);
    }

    /**
     * @return PostPipeContract[]
     */
    public function getPostPipes(): array
    {
        return $this->getInstancesOf(PostPipeContract::class);
    }

    /**
     * @return PumpContract[]
     */
    public function getPumps(): array
    {
        return $this->getInstancesOf(PumpContract::class);
    }
}
