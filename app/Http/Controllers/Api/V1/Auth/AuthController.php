<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Contracts\{
    Actions\User\LoginActionContract,
    Actions\User\LogoutActionContract,
    Actions\User\RefreshActionContract,
    Actions\User\UserDataActionContract,
    Actions\User\RegistrationActionContract
};

use App\Http\Requests\{
    Api\V1\Auth\LoginRequest,
    Api\V1\Auth\RegistrationRequest
};

use App\Facades\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     summary="Sign up",
     *     description="Register by name, email, password.",
     *     operationId="authRegister",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass a name and user credentials.",
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="user"),
     *             @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Wrong credentials response",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="Validation errors."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="array",
     *                     @OA\Items(type="string", example="The name is required.")
     *                 ),
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The email is required or has already been taken.")
     *                 ),
     *                 @OA\Property(property="password", type="array",
     *                     @OA\Items(type="string", example="The password is required or has more than 8 letters.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfull registration.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="true"),
     *             @OA\Property(property="message", type="string", example="You have successfully registered."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNjY0NTQxMDIwLCJleHAiOjE2NjQ1NDQ2MjAsIm5iZiI6MTY2NDU0MTAyMCwianRpIjoiRDE3M2YyYWxjWmE4NTViVyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.T1X55OPe7Fwr"),
     *                 @OA\Property(property="token_type", type="string", example="bearer"),
     *                 @OA\Property(property="expires_in", type="string", example="3600"),
     *             )
     *         )
     *     )
     * )
     *
     * @param RegistrationRequest $request
     * @param RegistrationActionContract $action
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function registration(RegistrationRequest $request, RegistrationActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('auth.response.200.register'),
            $action($request->toDTO()),
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Authorization",
     *     description="Authorization user by email and password to get Bearer Token",
     *     operationId="authLogin",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Pass a name and user credentials.",
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Wrong credentials response",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="Validation errors."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="email", type="array",
     *                     @OA\Items(type="string", example="The email is required or has already been taken.")
     *                 ),
     *                 @OA\Property(property="password", type="array",
     *                     @OA\Items(type="string", example="The password is required or has more than 8 letters.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized. Your credentials are wrong",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="Unauthorized. Your credentials are wrong"),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfull authorization.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="true"),
     *             @OA\Property(property="message", type="string", example="You have successfully logged in."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNjY0NTQxMDIwLCJleHAiOjE2NjQ1NDQ2MjAsIm5iZiI6MTY2NDU0MTAyMCwianRpIjoiRDE3M2YyYWxjWmE4NTViVyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.T1X55OPe7Fwr"),
     *                 @OA\Property(property="token_type", type="string", example="bearer"),
     *                 @OA\Property(property="expires_in", type="string", example="3600"),
     *             )
     *         )
     *     )
     * )
     *
     * @param LoginRequest $request
     * @param LoginActionContract $action
     * @return JsonResponse
     * @throws UnknownProperties
     */

    public function login(LoginRequest $request, LoginActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('auth.response.200.login'),
            $action($request->toDTO()),
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/me",
     *     summary="User data",
     *     description="Get autorization user data",
     *     operationId="authMe",
     *     tags={"Auth"},
     *     security={
     *         {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="Token not provided"),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfull get user data.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="true"),
     *             @OA\Property(property="message", type="string", example="You have successfully logged in."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="string", example="1"),
     *                 @OA\Property(property="name", type="string", example="User"),
     *                 @OA\Property(property="email", type="string", example="user@mail.com"),
     *                 @OA\Property(property="email_verified_at", type="string", example="null"),
     *                 @OA\Property(property="created_at", type="string", example="2022-12-22T15:14:06.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2022-12-22T15:14:06.000000Z"),
     *             )
     *         )
     *     )
     * )
     *
     * @param UserDataActionContract $action
     * @return JsonResponse
     */
    public function me(UserDataActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('auth.response.200.me'),
            $action(),
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     summary="User logout",
     *     description="User logout and clear a authorization token",
     *     operationId="authLogout",
     *     tags={"Auth"},
     *     security={
     *         {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="Token not provided"),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfull get user data.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="true"),
     *             @OA\Property(property="message", type="string", example="You have successfully logged out."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     *
     * @param LogoutActionContract $action
     * @return JsonResponse
     */
    public function logout(LogoutActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('auth.response.200.logout'),
            $action(),
        );
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/refresh",
     *     summary="Refresh token",
     *     description="This route can be use once by current authorization token",
     *     operationId="authRefresh",
     *     tags={"Auth"},
     *     security={
     *         {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response=422,
     *         description="Unauthorized.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="false"),
     *             @OA\Property(property="message", type="string", example="The token has been blacklisted"),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully refresh token.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="true"),
     *             @OA\Property(property="message", type="string", example="You have successfully refreshed token."),
     *             @OA\Property(property="version", type="string", example="v1"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNjY0NTQxMDIwLCJleHAiOjE2NjQ1NDQ2MjAsIm5iZiI6MTY2NDU0MTAyMCwianRpIjoiRDE3M2YyYWxjWmE4NTViVyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.T1X55OPe7Fwr"),
     *                 @OA\Property(property="token_type", type="string", example="bearer"),
     *                 @OA\Property(property="expires_in", type="string", example="3600"),
     *             )
     *         )
     *     )
     * )
     *
     * @param RefreshActionContract $action
     * @return JsonResponse
     */
    public function refresh(RefreshActionContract $action): JsonResponse
    {
        return ApiResponse::success(
            __('auth.response.200.refresh_token'),
            $action(),
        );
    }
}
