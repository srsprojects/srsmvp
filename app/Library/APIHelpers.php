<?php

namespace App\Library;

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

    protected function isAgent($user): bool
    {

        if (!empty($user)) {
            return $user->tokenCan('agent');
        }

        return false;
    }

    protected function isDepositor($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('depositor');
        }

        return false;
    }
    protected function isRider($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('rider');
        }

        return false;
    }

    protected function APISuccess($data, string $message = 'SUCCESS', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => ['code' => $code, 'message' => $message],
            'data' => $data,
        ], $code);
    }

    protected function APIError($data, int $code, string $message = 'ERROR'): JsonResponse
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
