<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Philly\Container\Collection;
use Philly\Container\FiltersTypes;
use Philly\Contracts\App;
use Philly\Contracts\Container\Collection as CollectionContract;
use Philly\Contracts\Pipeline\Pipe as PipeContract;
use Philly\Contracts\Pipeline\PipeGroup as PipeGroupContract;
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
        return $value instanceof PipeContract || $value instanceof PipeGroupContract;
    }

    /**
     * @inheritDoc
     */
    public function handle(App $app, Request $request): Response
    {
    	$app[Request::class] = $request;

	    $pump = $this->getHandlerPump($request);

	    $app[PumpContract::class] = $pump;

	    $globalPrePipes = $this->getGlobalPrePipes();
	    foreach ($pump->getPre() as $prePumpPipes)
	    	$globalPrePipes->add($prePumpPipes);

	    $globalPostPipes = $this->getGlobalPostPipes();
	    foreach ($pump->getPost() as $postPumpPipe)
	    	$globalPostPipes->add($postPumpPipe);

	    $result = $globalPrePipes[0]->handle($app, $request, function ($app, $innerRequest) use ($globalPrePipes, $globalPostPipes, $pump) {
			return $pump->handle($app, $innerRequest, function ($app, $innerResponse) use ($globalPostPipes) {
				return $globalPostPipes[0]->handle($app, $innerResponse, function ($app, $innerResponse2) {
					$app[Response::class] = $innerResponse2;

					return $innerResponse2;
				});
            });
	    });

	    return $result->getResult();
    }

	/**
	 * @inheritDoc
	 */
	public function addPump(PumpContract $pump): PipelineContract
	{
		$this->add($pump);

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function addGlobal(PipeGroupContract $group): PipelineContract
	{
		foreach ($group->getPre() as $pre)
			$this->add($pre);

		foreach ($group->getPost() as $post)
			$this->add($post);

		return $this;
	}

	/**
	 * @param Request $request The request to filter by.
	 *
	 * @return PumpContract|null The first pump which accepted the request or null if none accepted.
	 */
	private function getHandlerPump(Request $request): ?PumpContract
	{
		return $this
			->getInstancesOf(PumpContract::class)
			->first(function (PumpContract $pump) use ($request) {
				return $pump->accepts($request);
			});
	}

	/**
	 * @return PrePipeContract[] All registered pre-pump pipes in this pipeline.
	 */
	private function getGlobalPrePipes(): CollectionContract
	{
		return $this->getInstancesOf(PrePipeContract::class);
	}

	/**
	 * @return PostPipeContract[] All registered post-pump pipes in this pipeline.
	 */
	private function getGlobalPostPipes(): CollectionContract
	{
		return $this->getInstancesOf(PostPipeContract::class);
	}
}
