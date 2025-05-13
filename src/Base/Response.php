<?php

namespace MedicalappCore\AuthApiBridge\Base;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;

class BaseResonse
{
    public static function throwError(string $message)
    {
        throw ValidationException::withMessages([$message]);
    }

    /**
     * Returns 200 code.
     *
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    public static function success(
        string $message = "success",
        $data = []
    ): JsonResponse {
        return Response::json(
            [
                "message" => $message,
                "data" => $data,
                "status" => HttpResponse::HTTP_OK
            ],
            HttpResponse::HTTP_OK
        );
    }

    public static function badRequest(string $message = "", $data = [])
    {
        return Response::json(
            [
                "message" => $message,
                "data" => $data,
                "status" => HttpResponse::HTTP_BAD_REQUEST
            ],
            HttpResponse::HTTP_BAD_REQUEST
        );
    }

    public static function serverError(string $message = "", $data = [])
    {
        return Response::json(
            [
                "message" => $message,
                "data" => $data,
                "status" => HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            ],
            HttpResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public static function created(
        $data = [],
        string $message = "Successfully created."
    ) {
        return Response::json(
            [
                "message" => $message,
                "data" => $data,
                "status" => HttpResponse::HTTP_CREATED
            ],
            HttpResponse::HTTP_CREATED
        );
    }

    public static function deleted(string $message = "")
    {
        return Response::json(
            [
                "message" => $message,
                "status" => HttpResponse::HTTP_NO_CONTENT
            ],
            HttpResponse::HTTP_NO_CONTENT
        );
    }

    public static function download(string $filePath, array $headers)
    {
        return Response::make($filePath, HttpResponse::HTTP_OK, $headers);
    }

    public static function forbidden(string $message = "Forbidden.")
    {
        return Response::json(
            [
                "message" => $message,
                "status" => HttpResponse::HTTP_FORBIDDEN
            ],
            HttpResponse::HTTP_FORBIDDEN
        );
    }

    /**
     * Returns 200 code with cookie.
     *
     * @param string $message
     * @param array $data
     * @param $cookie
     * @return JsonResponse
     */
    public static function successWithCookie(
        string $message = "success",
        array $data = [],
        Cookie $cookie
    ): JsonResponse {
        return Response::json(
            [
                "message" => $message,
                "data" => $data,
                "status" => HttpResponse::HTTP_OK
            ],
            HttpResponse::HTTP_OK
        )->withCookie($cookie);
    }
}
