<?php
declare(strict_types=1);

namespace Philly\Exceptions;


use Philly\Contracts\Exceptions\ExceptionHandler as ExceptionHandlerContract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

/**
 * Class ExceptionHandler.
 */
class ExceptionHandler implements ExceptionHandlerContract
{
    /**
     * @inheritDoc
     */
    public function handle(Throwable $throwable): JsonResponse
    {
        $response = new JsonResponse(null, 500);

        $json = [];
        $json['class'] = get_class($throwable);
        $json['message'] = $throwable->getMessage();
        $json['code'] = $throwable->getCode();
        $json['file'] = $throwable->getFile();
        $json['line'] = $throwable->getLine();
        $json['previous'] = $throwable->getPrevious();
        $json['trace'] = [];

        foreach ($throwable->getTrace() as $item) {
            $item['args'] = [];
            $json['trace'][] = $item;
        }

        $response->setData($json);

        return $response;
    }
}
