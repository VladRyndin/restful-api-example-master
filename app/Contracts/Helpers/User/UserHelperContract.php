<?php

namespace App\Contracts\Helpers\User;

use App\Models\User;

interface UserHelperContract
{
    /**
     * Create a new user using the provided data array.
     *
     * @param array{
     *     name: string,
     *     email: string,
     *     password: string
     * } $data The data required to create a new user.
     * @return User The created user instance.
     */
    public function createUser(array $data): User;

    /**
     * Handle the login process for a user.
     *
     * @param array{
     *     email: string,
     *     password: string
     * } $credentials The user credentials required for authentication.
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|bool Returns an array containing user details on success, or false on failure.
     */
    public function loginProcess(array $credentials): array|bool;

    /**
     * Refresh the user's access token.'
     * @return array{
     *     access_token: string,
     *     token_type: string,
     *     expires_in: int
     * }|bool
     */
    public function refreshToken(): array|bool;
}
