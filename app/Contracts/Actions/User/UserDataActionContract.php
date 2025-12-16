<?php

namespace App\Contracts\Actions\User;

interface UserDataActionContract
{
    /**
     * Invoke the action for get user data.
     * @return array{
     *     id: int,
     *     name: string,
     *     email: string
     * }
     */
    public function __invoke(): array;
}
