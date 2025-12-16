<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\DataTransferObjects\User\Auth\LoginDTO;
use App\Http\Requests\Api\BaseFormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'     => 'required|max:255|email:rfc,dns|',
            'password'  => 'required|min:8',
        ];
    }

    /**
     * Convert the current request data into a Login Data Transfer Object (DTO).
     * @return LoginDTO
     * @throws UnknownProperties
     */
    public function toDTO(): LoginDTO
    {
        return new LoginDTO(
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
