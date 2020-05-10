<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Philly\Contracts\App;
use Philly\Contracts\Pipeline\PipeOutput;
use Philly\Contracts\Pipeline\PostPipeOutput;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostPipe
 */
class PostPipe extends Pipe implements \Philly\Contracts\Pipeline\PostPipe
{
	public function handle(App $app, Response $response): PostPipeOutput
	{
		// TODO: Implement handle() method.
	}
}
