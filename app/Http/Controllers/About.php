<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class About extends Controller
{
    public function page () {
        return view('pages.main.about', [
            'pageInfo' => [
                'title' => 'About',
                'description' => 'Understand about our system.'
            ],
        ]);
    }
}
