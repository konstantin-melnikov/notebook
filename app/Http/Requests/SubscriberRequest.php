<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
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
        /**
         * Use simple rules just for example
         */
        return [
            'id'        => 'nullable|integer',
            'full_name' => 'required|string|max:75',
            'phone'     => 'required|string|max:20',
            'email'     => 'required|email:rfc|max:100',
        ];
    }
}
