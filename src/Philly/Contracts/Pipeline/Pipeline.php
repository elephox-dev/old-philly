<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;

use Philly\Contracts\App;
use Philly\Contracts\Collection\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface LinkerChain
 */
interface Pipeline extends Collection
{
    /**
     * @param PrePipe $pipe
     * @return mixed
     */
    public function addPre(PrePipe $pipe);

    /**
     * @param PostPipe $pipe
     * @return mixed
     */
    public function addPost(PostPipe $pipe);

    /**
     * @param Pump $pump
     * @return mixed
     */
    public function addPump(Pump $pump);

    /**
     * @param App $app
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(App $app, Request $request): Response;
}
