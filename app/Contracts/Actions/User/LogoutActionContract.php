<?php

namespace App\Contracts\Actions\User;

interface LogoutActionContract
{
    /**
     * Invoke the action for logout user.
     */
    public function __invoke(): void;
}
