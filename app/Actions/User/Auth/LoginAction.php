<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\LoginActionContract;
use App\Contracts\Helpers\User\UserHelperContract;
use App\DataTransferObjects\User\Auth\LoginDTO;
use App\Facades\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginAction implements LoginActionContract
{
    /**
     * @param UserHelperContract $userHelper
     */
    public function __construct(private UserHelperContract $userHelper)
    {
    }

    /**
     * @param LoginDTO $data
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|HttpResponseException
     */
    public function __invoke(LoginDTO $data): array|HttpResponseException
    {
        $token = $this->userHelper->loginProcess($data->all());
        if (!$token) {
            throw new HttpResponseException(
                ApiResponse::auth(
                    __('auth.response.401.login'),
                )
            );
        }

        return $token;
    }
}
