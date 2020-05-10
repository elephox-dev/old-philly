<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;


use Philly\Contracts\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PostPipe
 */
interface PostPipe extends Pipe
{
    public function handle(App $app, Response $response): PostPipeOutput;
}
