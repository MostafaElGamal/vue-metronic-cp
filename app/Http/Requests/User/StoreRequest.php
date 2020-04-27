<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        "name" => "required|min:3|max:55|string|unique:users",
         "email" => "email|required|unique:users|max:255|string",
         "password" => "required|confirmed|min:8|string",
         'role' => 'required',
        ];
    }
}
