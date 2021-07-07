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

function OrderValidator() {
    return [
        'customer_id' => ['required'],
        'date' => ['required', 'date '],
        'status' => ['required', 'in:A,I'],
        'type' => ['required', 'in:B,V'],
        'observation' => ['nullable', 'string'],
    ];
}

function OrderServiceValidator() {
    return [
        'order_id' => ['required'],
        'service_id' => ['required'],
        'quantity' => ['required', 'integer'],
        'price' => ['required', 'numeric'],
        'status' => ['required', 'in:A,I'],
    ];
}

function ServiceValidator() {
    return [
        'name' => ['required', 'string', 'min:5', 'max:100'],
        'price' => ['required', 'numeric'],
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

function UserValidator($id = 0) {
    return [
        'name' => ['required', 'string', 'min:5', 'max:100'],
        'email' => ['required', 'string', 'email', 'min:5', 'max:100', "unique:users,email,{$id},id"],
        'password' => [$id==0 ?'required' : 'nullable', 'string', 'min:5', 'max:255'],
    ];
}
