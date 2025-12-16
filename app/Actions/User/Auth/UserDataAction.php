<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\UserDataActionContract;

class UserDataAction implements UserDataActionContract
{
    /**
     * Invoke the action for get user data.
     * @return array{
     *     id: int,
     *     name: string,
     *     email: string
     * }
     */
    public function __invoke(): array {
        $user = auth()->user();
        return $user !== null ? $user->toArray() : [];
    }
}
