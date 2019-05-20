<?php

namespace App\Application\Exceptions;

use App\Infrastructure\Resources\BaseResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use MongoDB\Driver\Exception\ServerException;
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
        if ($exception instanceof ModelNotFoundException) {
            return (new BaseResource(null, 'RecordNotFound', 'Запись не найдена'))
                ->response()->setStatusCode(404);
        }

        if ($exception instanceof HttpException or $exception instanceof NotFoundHttpException) {
            return (new BaseResource(null, 'UrlNotFound', 'URL не найден'))
                ->response()->setStatusCode(404);
        }

        if ($exception instanceof Exception)
        {
            $res = new BaseResource(null, 'GeneralInternalError', 'Произошла ошибка');
            return $res->response()->setStatusCode(500);
        }

        return parent::render($request, $exception);
    }
}
