<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Exception;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (($exception instanceof ValidationException) && $request->wantsJson()){
            return response()->json(['message' => trans('validation.generic.invalid_data'), 'errors' => $exception->validator->getMessageBag()], 422);
        }
        if(($exception instanceof AuthenticationException) && $request->wantsJson()){
            return response()->json(['error'=>trans('auth.failed')], 401);
        }
        if ($exception instanceof OAuthServerException && $request->wantsJson()) {
            if ($exception->statusCode() == 400){
                return response()->json(['error'=>trans('auth.incorret_params')], 400);
            }
            if ($exception->statusCode() == 401){
                return response()->json(['error'=>trans('auth.failed')], 401);
            }
            if ($exception->statusCode() == 500){
                return response()->json(['error'=>trans('validation.generic.failed_job')], 500);
            }
        }
        if (($exception instanceof Exception) && $request->wantsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['error'=>trans('validation.generic.api_not_found')], 404);
            }
            return response()->json(['error'=>trans('validation.generic.failed_job').": ".$exception->getMessage()], 500);
        }
        return parent::render($request, $exception);
    }
}
