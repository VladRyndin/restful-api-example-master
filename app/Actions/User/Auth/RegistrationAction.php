<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\RegistrationActionContract;
use App\Contracts\Helpers\User\UserHelperContract;
use App\DataTransferObjects\User\Auth\RegistrationDTO;
use App\Facades\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

readonly class RegistrationAction implements RegistrationActionContract
{

    /**
     * @param UserHelperContract $userHelper
     */
    public function __construct(private UserHelperContract $userHelper)
    {
    }

    /**
     * @param RegistrationDTO $data
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|HttpResponseException
     * @throws HttpResponseException
     */
    public function __invoke(RegistrationDTO $data): array|HttpResponseException
    {
        $user = $this->userHelper->createUser($data->all());
        $token = $this->userHelper->loginProcess([
            'email' => (string) $user->email,
            'password' => $data->password
        ]);

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
