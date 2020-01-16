<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;


use Philly\Contracts\App;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface PrePipe
 */
interface PrePipe extends Pipe
{
    /**
     * @param App $app
     * @param Request $request
     * @return PipeOutput
     */
    public function handle(App $app, Request $request): PipeOutput;
}
