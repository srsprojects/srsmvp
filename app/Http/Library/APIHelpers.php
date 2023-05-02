<?php

namespace App\Http\Library;

use Illuminate\Http\JsonResponse;

trait APIHelpers
{
    protected function isAdmin($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('admin');
        }

        return false;
    }

    protected function isHomie($user): bool
    {

        if (!empty($user)) {
            return $user->tokenCan('homie');
        }

        return false;
    }

    protected function isBuka($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('buka');
        }

        return false;
    }
    protected function isDelivery($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('delivery');
        }

        return false;
    }

    protected function onSuccess($data, string $message = 'SUCCESS', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => ['code' => $code, 'message' => $message],
            'data' => $data,
        ], $code);
    }

    protected function onError($data, int $code, string $message = 'ERROR'): JsonResponse
    {
        return response()->json([
            'status' => [
                'code' => $code,
                'message' => $message,
            ],
            'data' => $data
        ], $code);
    }

    protected function postValidationRules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }

    protected function userValidatedRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
