<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin(); // only admins can create
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|text',
            'price' => 'required|min:0',
        ];
    }
}
