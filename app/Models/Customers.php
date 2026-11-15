<?php

namespace App\Models;

class Customers extends BaseModel
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
    ];
}
