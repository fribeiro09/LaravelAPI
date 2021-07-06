<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTenant extends FormRequest
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
        $id = $this->segment(3);

        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:100'],
            'document_number' => ['required', 'string', 'document_number', 'min:5', 'max:100', "unique:tenants,document_number,{$id},id"],
            'email' => ['required', 'string', 'min:5', 'max:100'],
            'status' => ['required', 'in:A,I'],
        ];

        return $rules;
    }
}
