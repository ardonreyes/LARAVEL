<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class Customer extends Controller
{
    public function page () {
        return view('pages.main.customers', [
            'pageInfo' => [
                'title' => 'Customers',
                'description' => 'Registered customers in our system.'
            ],
            'data' => Customers::all(),
        ]);
    }
}
