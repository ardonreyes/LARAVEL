<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

abstract class Controller
{
    protected function validationForInsertAndUpdate(array $data, ?int $id = null): array
    {
        $rules = [
            'full_name' => ['required', 'string', 'regex:/^\p{L}+(?: \p{L}+)*$/u', 'min:2', 'max:100'],
        ];

        if (request()->is('customers/*')) {
            $rules['email'] = ['required', 'email', 'max:100', Rule::unique('customers', 'email')->ignore($id)];
            $rules['phone'] = ['required', 'regex:/^0[0-9]{10}$/', Rule::unique('customers', 'phone')->ignore($id)];
        } else {
            $rules['username'] = ['required', 'string', 'regex:/^[\p{L}\p{N}_-]+$/u', 'min:2', 'max:50', Rule::unique('users', 'username')->ignore($id)];
            $rules['role'] = ['required', Rule::in([$id === null ? 'User' : Users::getData($id)->role])];
        }

        return Validator::make($data, $rules)->validate();
    }
}
