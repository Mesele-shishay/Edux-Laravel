<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create users');
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname'        => 'required|string',
            'lname'         => 'required|string',
            'gender'            => 'required|string',
            'phoneNumber'             => 'required|string',
            'teacher_photo'             => 'required|image',
            'birthDate'          => 'required|date',
            'zone'          => 'required|string',
            'field'        => 'required|string',
            'woreda'          => 'required|string',
        ];
    }
}
