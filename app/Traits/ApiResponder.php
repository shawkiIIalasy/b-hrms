<?php

namespace App\Traits;

use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, string $message = null, int $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code = Response::HTTP_NOT_FOUND, $errors = null)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors ?? [],
        ], $code);
    }

    /**
     * Return an OK JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ok()
    {
        return response()->json([
            'status' => 'Success',
        ], Response::HTTP_OK);
    }
}
