<?php

namespace Modules\Teacher\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherLoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Dữ liệu không được để trống',
            'password.required' => 'Dữ liệu không được để trống',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
