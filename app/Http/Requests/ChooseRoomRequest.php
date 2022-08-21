<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChooseRoomRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'count_person' => ['required','numeric'],
            'check_in' => ['required','date','after_or_equal:today'],
            'check_out' => ['required','date','after:check_in']
        ];
    }
}
