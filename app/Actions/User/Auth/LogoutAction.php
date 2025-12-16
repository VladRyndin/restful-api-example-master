<?php

namespace App\Actions\User\Auth;

use App\Contracts\Actions\User\LogoutActionContract;

class LogoutAction implements LogoutActionContract
{
    /**
     * Invoke the action for logout user.
     */
    public function __invoke(): void
    {
        auth()->logout();
    }
}
