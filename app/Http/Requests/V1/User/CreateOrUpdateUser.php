<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateOrUpdateUser extends FormRequest
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
    public function rules(Request $request)
    {
        $method = $request->method();
        $rules = [];
        if ($method == "POST"){
            $rules = [
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password',
            ];
        } elseif ($method == "PUT"){
            $rules = [
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email,'.$request->id,
                'password' => 'nullable|min:6',
                'password_confirm' => 'nullable|same:password',
            ];
        } elseif ($method == "DELETE"){
            $rules = [
                'id' => 'required|numeric|min:0',
            ];
        }
        return $rules;
    }
}
