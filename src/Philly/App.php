<?php
declare(strict_types=1);

namespace Philly;

use Philly\Contracts\App as AppContract;
use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Philly\Contracts\Routing\Pipeline as PipelineContract;
use Philly\Exceptions\ExceptionHandler;
use Philly\Routing\Pipeline;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

/**
 * Class App
 */
class App extends Container\BindingContainer implements AppContract
{
    /**
     * @var array
     */
    protected array $pipes = [];

    /**
     * App constructor.
     */
    public function __construct()
    {
        // bind this app instance to its own class
        $this[AppContract::class] = $this;
    }

    /**
     * @return PipelineContract
     */
    protected function getPipeline(): PipelineContract
    {
        if (!$this->has(PipelineContract::class))
            $this->bind(PipelineContract::class, new Pipeline(), true);

        $pipeline = $this[PipelineContract::class];

        assert($pipeline instanceof PipelineContract, "Invalid pipeline type!");

        return $pipeline;
    }

    /**
     * @inheritDoc
     */
    protected function addPipes(): void
    {
        $pipeline = $this->getPipeline();

        foreach ($this->getPipes() as $pipe)
            $pipeline->add($pipe);
    }

    /**
     * @return array
     */
    protected function getPipes(): array
    {
        return $this->pipes;
    }

    /**
     * @return ExceptionHandlerContract
     */
    protected function getExceptionHandler(): ExceptionHandlerContract
    {
        if (!$this->has(ExceptionHandlerContract::class))
            $this->bind(ExceptionHandlerContract::class, new ExceptionHandler(), true);

        $handler = $this[ExceptionHandlerContract::class];

        assert($handler instanceof ExceptionHandlerContract, "Invalid exception handler type!");

        return $handler;
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request): JsonResponse
    {
        $this[Request::class] = $request;

        $this->addPipes();

        try
        {
            $pipeline = $this->getPipeline();

            $response = $pipeline->pass($this, $request);
        }
        catch (Throwable $throwable)
        {
            $handler = $this->getExceptionHandler();

            $response = $handler->handle($throwable);
        }

        return $response;
    }
}
