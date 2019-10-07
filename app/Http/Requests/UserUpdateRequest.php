<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('users')->ignore(auth()->user()), 'min:2', 'string'],
            'password' => ['sometimes', 'nullable', 'confirmed', 'string', 'min:6', new StrongPassword],
            'picture' => 'sometimes|image',
        ];
    }
}
