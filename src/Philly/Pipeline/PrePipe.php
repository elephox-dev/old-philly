<?php
declare(strict_types=1);

namespace Philly\Pipeline;

use Philly\Contracts\App;
use Philly\Contracts\Pipeline\PipeOutput;
use Philly\Contracts\Pipeline\PrePipeOutput;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PrePipe
 */
class PrePipe extends Pipe implements \Philly\Contracts\Pipeline\PrePipe
{
	public function handle(App $app, Request $request): PrePipeOutput
	{
		// TODO: Implement handle() method.
	}
}
