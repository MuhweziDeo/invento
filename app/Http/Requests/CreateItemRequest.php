<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'data_entrant' ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'size' => 'required|string',
            'brand' => 'required|string',
            'cost' => 'required|integer',
            'quantity' => 'required|integer',
            'minimum_quantity' => 'required|integer'
        ];
    }
}
