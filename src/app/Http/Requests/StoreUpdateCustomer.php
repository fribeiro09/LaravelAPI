<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCustomer extends FormRequest
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
            'document_number' => ['required', 'string', 'email', 'min:5', 'max:100', "unique:customers,document_number,{$id},id"],
            'zipcode' => ['required', 'string', 'min:5', 'max:8'],
            'address' => ['required', 'string', 'min:5', 'max:100'],
            'complement' => ['nullable', 'string', 'min:5', 'max:100'],
            'district' => ['required', 'string', 'min:5', 'max:100'],
            'city' => ['required', 'string', 'min:5', 'max:100'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'cellular' => ['required', 'string', 'min:5', 'max:11'],
            'email' => ['required', 'string', 'min:5', 'max:100'],
            'status' => ['required', 'in:A,I'],
        ];

        return $rules;
    }
}
