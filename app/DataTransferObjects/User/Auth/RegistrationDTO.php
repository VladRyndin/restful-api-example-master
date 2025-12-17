<?php

namespace App\DataTransferObjects\User\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class RegistrationDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var ?string
     */
    public ?string $ip;
}
