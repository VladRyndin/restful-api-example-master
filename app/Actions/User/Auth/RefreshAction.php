<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\RefreshActionContract;
use App\Contracts\Helpers\User\UserHelperContract;
use App\Facades\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;

class RefreshAction implements RefreshActionContract
{
    public function __construct(private UserHelperContract $userHelper) {

    }

    /**
     * Handles the token refresh process for a user.
     *
     * Retrieves a refreshed authentication token using the user helper. If the process fails to generate a token,
     * an HTTP response exception is thrown with the corresponding error message.
     *
     * Catches exceptions related to token blacklisting or general JWT issues
     * and throws an HTTP response exception with the appropriate authentication error message.
     *
     * @return array The refreshed token.
     *
     * @throws HttpResponseException If the token refresh fails or an exception occurs during the process.
     */
    public function __invoke(): array
    {
        try {
            $token = $this->userHelper->refreshToken();
            if (!$token) {
                throw new HttpResponseException(
                    ApiResponse::error(
                        __('auth.response.422.token'),
                        code:422
                    )
                );
            }

            return $token;
        } catch(TokenBlacklistedException | JWTException $err) {
            throw new HttpResponseException(
                ApiResponse::auth(
                    $err->getMessage(),
                    code:422
                )
            );
        }
    }
}
