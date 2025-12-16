<?php

namespace App\DataTransferObjects\User\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class RegistrationDTO extends DataTransferObject
{
    /**
     * @var string
     */
    public string $first_name;

    /**
     * @var string
     */
    public string $last_name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * @var int
     */
    public int $app_pricing_plan_id;

    /**
     * @var string
     */
    public string $ip;
}
