<?php

return [
    \App\Contracts\Actions\User\RegistrationActionContract::class => \App\Actions\User\Auth\RegistrationAction::class,
    \App\Contracts\Actions\User\LoginActionContract::class => \App\Actions\User\Auth\LoginAction::class,
    \App\Contracts\Actions\User\UserDataActionContract::class => \App\Actions\User\Auth\UserDataAction::class,
    \App\Contracts\Actions\User\LogoutActionContract::class => \App\Actions\User\Auth\LogoutAction::class,
];
