<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer extends Controller
{
    public function page () {
        return view('pages.main.customers', [
            'pageInfo' => [
                'title' => 'Customers',
                'description' => 'Registered customers in our system.'
            ],
            'data' => $this->data,
        ]);
    }
}
