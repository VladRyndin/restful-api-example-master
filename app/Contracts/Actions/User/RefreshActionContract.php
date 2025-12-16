<?php

namespace App\Contracts\Actions\User;

use App\Contracts\Helpers\User\UserHelperContract;

interface RefreshActionContract
{

    /**
     * Create a new controller instance.
     * @param UserHelperContract $userHelper
     */
    public function __construct(UserHelperContract $userHelper);

    /**
     * Invoke the action for refresh user token.
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int,
     * }
     */
    public function __invoke(): array;
}
