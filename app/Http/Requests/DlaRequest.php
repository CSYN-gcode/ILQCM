<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DlaRequest extends FormRequest
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
            // dla_check_items[0][value]
            //
        ];
    }
}
