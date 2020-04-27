<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UpdateRequest extends FormRequest
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
    public function rules(Request $req)
    {
        return [
            "name" => ["required",Rule::unique('users', 'name')->ignore($req->id)],
            "email" => ["required","email",Rule::unique('users', 'email')->ignore($req->id)],
            "password" => "nullable|min:8|confirmed",
            'role' => 'required'
        ];
    }
}
