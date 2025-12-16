<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Helpers\User\UserHelperContract;
use App\DataTransferObjects\User\Auth\RegistrationDTO;
use Illuminate\Http\Exceptions\HttpResponseException;

interface RegistrationActionContract
{

    /**
     * @param UserHelperContract $userHelper
     */
    public function __construct(UserHelperContract $userHelper);

    /**
     * @param RegistrationDTO $data
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|HttpResponseException
     */
    public function __invoke(RegistrationDTO $data): array|HttpResponseException;
}
