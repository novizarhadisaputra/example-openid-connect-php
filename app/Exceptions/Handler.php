<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use App\Interfaces\Http\Controllers\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Exception $e, Request $request) {
            if ($request->expectsJson()) {
                return $this->respondWithErrorWithCustomData(null, $e->getMessage());
            }
        });
    }
}
