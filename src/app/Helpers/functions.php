<?php

function CustomerValidator($id = 0) {
    return [
        'name' => ['required', 'string', 'min:5', 'max:100'],
        'document_number' => ['required', 'string', 'min:5', 'max:100', "unique:customers,document_number,{$id},id"],
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
}

function TenantValidator($id = 0) {
    return [
        'name' => ['required', 'string', 'min:5', 'max:100'],
        'document_number' => ['required', 'string', 'min:5', 'max:100', "unique:tenants,document_number,{$id},id"],
        'email' => ['required', 'string', 'min:5', 'max:100'],
        'status' => ['required', 'in:A,I'],
    ];
}
