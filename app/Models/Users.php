<?php

namespace App\Models;

class Users extends BaseModel
{
    protected $fillable = [
        'full_name',
        'username',
        'role',
        'profile',
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
