<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class Home extends Controller
{
    public function page () {
        return view('pages.main.home', [
            'pageInfo' => [
                'title' => 'Home',
                'description' => 'Welcome, manage your POS.'
            ],
            'data' => [
                'userCount' => count(Users::all())
            ],
        ]);
    }
}
