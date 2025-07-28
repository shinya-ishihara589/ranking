<?php

namespace App\Http\Requests;

use App\Rules\CheckOnetimePassword;
use App\Rules\CheckValidityPeriodOnetimePassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'register_onetime_password' => [
                'required',
                'max:255',
                new CheckValidityPeriodOnetimePassword($this->register_user_id, $this->register_email),
                new CheckOnetimePassword($this->register_user_id, $this->register_email),
            ],
        ];
    }
}
