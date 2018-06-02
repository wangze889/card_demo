<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    private $code;
    private $msg;
    private $errorCode;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if(config('kaiguan.api_return')){
            if($request->is('api/*')) {
                if($exception instanceof BaseException){
                    $this->errorCode = $exception->errorCode;
                    $this->code = $exception->code;
                    $this->msg = $exception->msg;
                }else{
                    $error = $this->convertExceptionToResponse($exception);
                    $this->code = $error->getStatusCode();
                    $this->msg = 'something error';
                    $this->errorCode = 10000;
                    if (config('app.debug')) {
                        $this->msg = empty($exception->getMessage()) ? 'something error' : $exception->getMessage();
//                if ($error->getStatusCode() >= 500) {
//                    if (config('app.debug')) {
//                        $response['trace'] = $exception->getTraceAsString();
//                        $response['code'] = $exception->getCode();
//                    }
//                }
                    }
                }
                $response = [
                    'code'=>$this->code,
                    'errorCode'=>$this->errorCode,
                    'msg'=>$this->msg,
                ];
                return response()->json($response, $this->code);
            }else{
                return parent::render($request, $exception);
            }
        }else{
            return parent::render($request, $exception);
        }
    }
}
