<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PostPipeOutput
 */
interface PostPipeOutput extends PipeOutput
{
	public function getResult(): Response;
}
