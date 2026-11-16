<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class User extends Controller
{
    public function read(): View
    {
        return view('pages.main.users', [
            'pageInfo' => [
                'title' => 'Users',
                'description' => 'Registered users in our system.',
            ],
            'data' => Users::getAll(),
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        Users::insertRow([
            ...$this->userData($request),
            'password' => Str::random(32),
        ]);

        return redirect('/users')->with('feedback', 'User created successfully.');
    }

    public function update(Request $request, int $num): RedirectResponse
    {
        Users::updateRow($num, $this->userData($request, $num));

        return redirect('/users')->with('feedback', 'User updated successfully.');
    }

    public function delete(int $num): RedirectResponse
    {
        Users::deleteRow($num);

        return redirect('/users')->with('feedback', 'User deleted successfully.');
    }

    private function userData(Request $request, ?int $num = null): array
    {
        $data = $this->validationForInsertAndUpdate($request->all(), $num);
        unset($data['profile']);

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = $profile->hashName();
            $profile->move(public_path('img/profiles'), $filename);
            $data['profile'] = 'img/profiles/'.$filename;
        }

        return $data;
    }
}
