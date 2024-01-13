<?php

namespace App\Exceptions;

use App\APiService\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->error('', 404, $e->getMessage());
        }
        if ($e instanceof NotFoundHttpException) {
            return $this->error('', 404, $e->getMessage());
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->error('', 404, $e->getMessage());
        }
        if ($e instanceof \Exception) {
            return $this->error('', 404, $e->getMessage());
        }
        if (config('app.debug')) {
            return Parent::render($request, $e);
        }
    }
}
