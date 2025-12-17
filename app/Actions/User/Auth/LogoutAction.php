<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\LogoutActionContract;

class LogoutAction implements LogoutActionContract
{
    /**
     * Invoke the action for logout user.
     * @return bool
     */
    public function __invoke(): bool
    {
        auth()->logout();
        return true;
    }
}
