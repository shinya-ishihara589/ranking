<?php

namespace App\Http\Requests;

use App\Rules\UniqueTmpRegister;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TmpRegisterFormRequest extends FormRequest
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
            'tmp_register_user_id' => [
                'required',
                'max:255',
                Rule::unique('users', 'user_id')->where('user_id', $this->tmp_register_user_id)->whereNull('deleted_at'),
                new UniqueTmpRegister('user_id'),
            ],
            'tmp_register_email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->where('email', $this->tmp_register_email)->whereNull('deleted_at'),
                new UniqueTmpRegister('email'),
            ],
        ];
    }
}
