<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'firstname'=>'required|min:3|string',
            'lastname'=>'required|min:3|string',
            'email'=>'required|email',
            'phone_number'=>'required|numeric|digits:10',
            'birthdate'=>'before:today',
            'notes'=>'string',
        ];
    }
}
