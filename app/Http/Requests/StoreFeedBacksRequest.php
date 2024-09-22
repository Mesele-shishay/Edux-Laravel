<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedBacksRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        /**
         * Change redirect route to previous route and contact section
        */
        $this->redirect = url()->previous() ."#contact";

        return [
            'name'  => 'required|min:3',
            'email'  => 'email',
            'comment'     => 'required|min:3',

        ];
    }
}
