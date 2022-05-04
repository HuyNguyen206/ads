<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $message = 'Success') {

            return Response::json([
                'errors' => false,
                'data' => $data,
                'message' => $message
            ]);
        });

        Response::macro('error', function ($message = '', $code = '', $status = 400) {
            if (!$message) {
                $message = "Error";
            }

            return Response::json([
                'errors'  => true,
                'code'    => $code,
                'message' => $message,
            ], $status);
        });

        // No content
        Response::macro('noContent', function ($status = 204) {
            return Response::json([], $status);
        });
    }
}
