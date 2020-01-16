<?php
declare(strict_types=1);

namespace Philly\Contracts\Pipeline;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface PipeOutput
 */
interface PipeOutput
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool;

    /**
     * @return Response|Request
     */
    public function getResult();
}
