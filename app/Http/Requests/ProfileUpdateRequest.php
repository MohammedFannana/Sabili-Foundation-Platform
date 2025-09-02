<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['required','string','email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['sometimes' , 'string'],
            'image' => ['nullable', 'image' , 'dimensions:min_width=100,min_height=100','max:1048576'],
        ];

    }
}


