<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

use Philly\Contracts\App;
use Philly\Contracts\Container\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface LinkerChain
 */
interface Pipeline extends Collection
{
    /**
     * @return mixed
     */
    public function addPre(PrePipe $pipe);

    /**
     * @return mixed
     */
    public function addPost(PostPipe $pipe);

    /**
     * @return mixed
     */
    public function addPump(Pump $pump);

    /**
     * @return JsonResponse
     */
    public function handle(App $app, Request $request): Response;
}
