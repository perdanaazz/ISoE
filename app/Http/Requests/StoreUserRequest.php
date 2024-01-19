<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email|max:255',
            'gender'     => 'required|integer|in:0,1',
            'birth_date' => 'required|date|before:today',
            'address'    => 'required|string',
            'division'   => 'required|string|max:255',
            'level'      => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'salary'     => 'required|integer',
            'photo'      => 'required',
        ];
    }
}
