<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function page () {
        return view('pages.main.users', [
            'pageInfo' => [
                'title' => 'Users',
                'description' => 'Registered users in our system.'
            ],
            'data' => $this->data,
        ]);
    }
}
