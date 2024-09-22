<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'student_photo'             => 'image',
            'birthDate'          => 'required|date',
            'zone'          => 'required|string',
            'field'        => 'required|string',
            'woreda'          => 'required|string',

            // Parents' information
            'father_name'       => 'required|string',
            'father_phone'      => 'required|string',
            'mother_name'       => 'required|string',
            'mother_phone'      => 'required|string',

            // Academic information
            'class_id'          => 'required',
            'section_id'        => 'required',
            'session_id'        => 'required',
            'role'    => 'required',
        ];
    }
}
