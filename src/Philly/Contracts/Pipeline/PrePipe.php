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
     * Handle a request. The result may contain a response if the request was not successful.
     */
    public function handle(App $app, Request $request, callable $next): PrePipeOutput;
}
