<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Helpers\User\UserHelperContract;
use App\DataTransferObjects\User\Auth\LoginDTO;
use Illuminate\Http\Exceptions\HttpResponseException;

interface LoginActionContract
{
    /**
     * @param UserHelperContract $userHelper
     */
    public function __construct(UserHelperContract $userHelper);

    /**
     * Handle the login process.
     *
     * @param LoginDTO $data
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|HttpResponseException
     */
    public function __invoke(LoginDTO $data): array|HttpResponseException;
}
