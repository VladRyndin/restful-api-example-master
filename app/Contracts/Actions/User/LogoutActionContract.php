<?php

namespace App\Contracts\Actions\User;

interface LogoutActionContract
{
    /**
     * Invoke the action for logout user.
     * @return bool
     */
    public function __invoke(): bool;
}
