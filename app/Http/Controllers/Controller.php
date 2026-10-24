<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected array $data = [
        [
            'username' => 'ardonreyes',
            'full_name' => 'Ardon Reyes',
            'email' => 'ardon.reyes@gmail.com',
            'phone' => '0912345671',
            'role' => 'Admin',
        ],
        [
            'username' => 'samanthaching',
            'full_name' => 'Samantha Ching',
            'email' => 'samantha.ching@gmail.com',
            'phone' => '0912345672',
            'role' => 'Admin',
        ],
        [
            'username' => 'carleugenio',
            'full_name' => 'Carl Eugenio',
            'email' => 'carl.eugenio@gmail.com',
            'phone' => '0912345673',
            'role' => 'User',
        ],
        [
            'id' => 4,
            'username' => 'ayezaarcilla',
            'full_name' => 'Ayeza Arcilla',
            'email' => 'ayeza.arcilla@gmail.com',
            'phone' => '0912345674',
            'role' => 'User',
        ],
        [
            'username' => 'diongelesvanderbilt',
            'full_name' => 'Diongeles Vanderbilt',
            'email' => 'diongeles.vanderbilt@gmail.com',
            'phone' => '0912345675',
            'role' => 'User',
        ],
    ];
    
}
