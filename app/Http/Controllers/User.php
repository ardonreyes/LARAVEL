<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class User extends Controller
{
    public function read()
    {
        return view('pages.main.users', [
            'pageInfo' => [
                'title' => 'Users',
                'description' => 'Registered users in our system.',
            ],
            'data' => Users::getAll(),
        ]);
    }

    public function create(Request $request)
    {
        Users::insertRow([
            ...$this->validationForInsertAndUpdate($request->all()),
            'password' => Str::random(32),
        ]);

        return redirect('/users')->with('feedback', 'User created successfully.');
    }

    public function update(Request $request, int $num)
    {
        Users::updateRow($num, $this->validationForInsertAndUpdate($request->all(), $num));

        return redirect('/users')->with('feedback', 'User updated successfully.');
    }

    public function delete(int $num)
    {
        Users::deleteRow($num);

        return redirect('/users')->with('feedback', 'User deleted successfully.');
    }
}
