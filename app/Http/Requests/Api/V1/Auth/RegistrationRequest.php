<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\DataTransferObjects\User\Auth\RegistrationDTO;
use App\Http\Requests\Api\BaseFormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegistrationRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|max:255',
            'email'                 => 'required|max:255|email:rfc,dns|unique:users,email|',
            'password'              => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required|min:8|max:255'
        ];
    }

    /**
     * Convert the current request data into a Registration Data Transfer Object (DTO).
     *
     * @return RegistrationDTO
     * @throws UnknownProperties
     */
    public function toDTO(): RegistrationDTO
    {
        return new RegistrationDTO(
            first_name: $this->get('name'),
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
