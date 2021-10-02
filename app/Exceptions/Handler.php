<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return new ErrorResource($e, 404, 'ERR4004');
        });

        $this->renderable(function (ValidationException $e, $request) {
            return new ErrorResource($e->errors(), 422, 'ERR4022');
        });

        $this->renderable(function (\Exception $e) {
            return new ErrorResource($e);
        });
    }
}
