<?php

namespace App\Helpers\User;

use App\Contracts\Helpers\User\UserHelperContract;
use App\Models\User;

class UserHelper implements UserHelperContract
{
    private string $token = '';

    const string TOKEN_TYPE = 'bearer';

    /**
     * Create a new user record in the database.
     *
     * @param array{
     *     name: string,
     *     email: string,
     *     password: string
     * } $data An associative array containing user data. Expected keys are 'name', 'email', and 'password'.
     * @return User The newly created User model instance.
     */
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    /**
     * Handles the login process by attempting authentication with provided credentials.
     *
     * @param array{
     *     email: string,
     *     password: string
     * } $credentials The user's login credentials.
     *
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|bool Returns an array with token data on successful authentication, or false on failure.
     */
    public function loginProcess(array $credentials): array|bool
    {
        if (! $this->token = auth()->attempt($credentials)) {
            return false;
        }

        return $this->getTokenData();
    }

    /**
     * Refreshes the user's access token.
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|bool
     '
     */
    public function refreshToken(): array|bool
    {
        if (! $this->token = auth()->refresh()) {
            return false;
        }

        return $this->getTokenData();
    }

    /**
     * Returns an array containing the token data.
     * @return array
     */
    protected function getTokenData(): array {
        return [
            'access_token'  => $this->token,
            'token_type'    => self::TOKEN_TYPE,
            'expires_in'    => auth()->factory()->getTTL() * 60
        ];
    }
}
