<?php

namespace App\Http\Requests;

use App\Common;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApplyFormRequest extends FormRequest
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
            'send_apply_type' => [
                'required',
                Rule::in(Common::getApplyTypes()),
            ],
            'send_apply_text' => 'required|max:1000',
        ];
    }
}
