<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {

            if ($e instanceof ModelNotFoundException && $request->expectsJson()) {
                return response()->json([
                    'message' => '找不到資料',
                ], 404);
            }
            
            if ($request->expectsJson()) {
                return response()->json(['error' => '發生錯誤'], 500);
            }

            // 一般的錯誤處理 
            return parent::render($request, $e);
    
        });
    }
}
