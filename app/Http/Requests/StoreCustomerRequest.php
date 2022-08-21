<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'address' => ['required','max:255'],
            'job' => ['required'],
            'birth_date' => ['required','date'],
            'gender' => ['required','in:Male,Female'],
            'email' => ['required','unique:users','email'],
            'avatar' => ['mimes:png,jpg'],
        ];
    }
}
