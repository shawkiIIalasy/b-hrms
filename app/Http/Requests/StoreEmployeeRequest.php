<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => 'required|between:2,255',
            'last_name' => 'required|between:2,255',
            'email' => 'required|email|unique:users|between:2,255',
            'password' => 'required|between:2,255',
            'phone' => 'required|between:2,255',
            'country_id' => 'required|exists:countries,id',
            'position_id' => 'required|exists:positions,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
