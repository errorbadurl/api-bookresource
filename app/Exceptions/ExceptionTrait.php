<?php 

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{
    public function ApiException($request, $exception)
    {
        if ($this->isModel($exception)) {
            return response()->json([
                'errors' => 'Model not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($this->isHttp($exception)) {
            return response()->json([
                'errors' => 'Route not found'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($this->isMethod($exception)) {
            return response()->json([
                'errors' => 'Method not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }

    protected function isModel($ex)
    {
        return $ex instanceof ModelNotFoundException;
    }

    protected function isHttp($ex)
    {
        return $ex instanceof NotFoundHttpException;
    }

    protected function isMethod($ex)
    {
        return $ex instanceof MethodNotAllowedHttpException;
    }
}
