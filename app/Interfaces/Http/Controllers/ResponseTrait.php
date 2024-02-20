<?php

namespace App\Interfaces\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use stdClass;

trait ResponseTrait
{
    protected string $resourceItem;
    protected string $resourceCollection;

    protected function respondWithCustomData($data, $status = 200): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], $status);
    }

    protected function getTimestampInMilliseconds(): int
    {
        return intdiv((int)now()->format('Uu'), 1000);
    }

    protected function respondWithNoContent(): JsonResponse
    {
        return new JsonResponse([
            'data' => null,
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], Response::HTTP_NO_CONTENT);
    }

    protected function respondWithCollection(LengthAwarePaginator $collection)
    {
        return (new $this->resourceCollection($collection))->additional(
            ['meta' => ['timestamp' => $this->getTimestampInMilliseconds()]]
        );
    }

    protected function respondWithItem(Model $item)
    {
        return (new $this->resourceItem($item))->additional(
            ['meta' => ['timestamp' => $this->getTimestampInMilliseconds()]]
        );
    }

    protected function respondWithCustomItem($item)
    {
        return (new $this->resourceItem($item))->additional(
            ['meta' => ['timestamp' => $this->getTimestampInMilliseconds()]]
        );
    }

    protected function respondNotFound($message = 'Resource not found'): JsonResponse
    {
        return $this->respondWithError($message, Response::HTTP_NOT_FOUND);
    }

    protected function respondWithError($message, $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'error' => [
                'message' => $message,
                'status' => $status,
            ],
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], $status);
    }

    protected function respondWithErrorWithCustomData($data, $message, $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
            'error' => [
                'message' => $message,
                'status' => $status,
            ],
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], $status);
    }
}
