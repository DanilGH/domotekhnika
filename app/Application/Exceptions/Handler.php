<?php

namespace App\Application\Exceptions;

use App\Interfaces\Api\Resources\Error\ErrorResource;
use App\Interfaces\Api\Resources\Error\ValidationErrorResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return (new ValidationErrorResource($exception->errors(), 'FieldInvalid', 'Поле содержит недопустимое значение'))
                ->response()->setStatusCode(422);
        }

        if ($exception instanceof ModelNotFoundException) {
            return (new ErrorResource([$exception->getMessage()], 'RecordNotFound', 'Запись не найдена'))
                ->response()->setStatusCode(404);
        }

        if ($exception instanceof HttpException or $exception instanceof NotFoundHttpException) {
            return (new ErrorResource([$exception->getMessage()], 'UrlNotFound', 'URL не найден'))
                ->response()->setStatusCode(404);
        }

        if ($exception instanceof Exception)
        {
            $res = new ErrorResource([$exception->getMessage()], 'GeneralInternalError', 'Произошла ошибка');
            return $res->response()->setStatusCode(500);
        }

        return parent::render($request, $exception);
    }
}
