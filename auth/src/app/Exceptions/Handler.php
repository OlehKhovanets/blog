<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\Responsible;

class Handler extends ExceptionHandler
{
    use Responsible;

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
     * @throws \Exception
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
        if ($request->wantsJson()) {   //add Accept: application/json in request
            return $this->handleApiException($request, $exception);
        } else {
        return parent::render($request, $exception);
        }
    }

    protected function handleApiException($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);
        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception, $request);
    }

    private function customApiResponse($exception, $request)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];
        ;
        /**
         * @var Exception $exception
         * check http code and combine put messages and errors
         */
        switch ($statusCode) {
            case 401:
                $response['message'] = 'exception.Unauthorized';
                $response['errors'] = [];
                break;
            case 403:
                $response['message'] = 'exception.Forbidden';
                $response['errors'] = [];
                break;
            case 404:
                $response['message'] = 'exception.notFound';
                $response['errors'] = [];
                break;
            case 405:
                $response['message'] = 'exception.methodNotAllowed';
                $response['errors'] = [];
                break;
            case 422:
                $response['message'] = 'exception.validationErrors';
                if (method_exists($exception, 'getData')) {
                    $response['errors'] = $exception->getData();
                } else {
                    $response['errors'] = $exception->getMessage();
                }
                break;
            default:
                $response['message'] = ($statusCode !== 500) ?  : 'Whoops, looks like something went wrong';
                $response['errors'] = ['error' => $exception->getMessage()];
                break;
        }

        $response['status'] = $statusCode;

        $responseObject = [
            'status' => $statusCode === 200 ? true : false,
            'processId' => '',
            'serviceId' => config('app.serviceId'),
            'code' => $statusCode,
            'data' => [
                "message" => $response['message'],
                "errors" => $response['errors'],
            ]
        ];

        if (config('app.debug') && $statusCode !== 422) {
            $responseObject['data']['trace'] = $exception->getTrace();
            $responseObject['data']['code'] = $exception->getCode();
        }
        //trait Responsible
        return $this->response($responseObject['code'], '',
            $responseObject['data']);
    }
}
