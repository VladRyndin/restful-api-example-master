<?php

namespace App\DataTransferObjects\User\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;
}
