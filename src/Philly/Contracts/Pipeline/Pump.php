<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;


use Philly\Contracts\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface Pump
 */
interface Pump extends Pipe
{
    /**
     * @param Request $request
     * @return bool
     */
    public function accepts(Request $request): bool;

    /**
     * @param App $app
     * @param Request $request
     * @return Response
     */
    public function handle(App $app, Request $request): Response;
}
