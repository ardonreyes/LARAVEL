<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class Customer extends Controller
{
    public function read()
    {
        return view('pages.main.customers', [
            'pageInfo' => [
                'title' => 'Customers',
                'description' => 'Registered customers in our system.',
            ],
            'data' => Customers::getAll(),
        ]);
    }

    public function create(Request $request)
    {
        Customers::insertRow($this->validationForInsertAndUpdate($request->all()));

        return redirect('/customers')->with('feedback', 'Customer created successfully.');
    }

    public function update(Request $request, int $num)
    {
        Customers::updateRow($num, $this->validationForInsertAndUpdate($request->all(), $num));

        return redirect('/customers')->with('feedback', 'Customer updated successfully.');
    }

    public function delete(int $num)
    {
        Customers::deleteRow($num);

        return redirect('/customers')->with('feedback', 'Customer deleted successfully.');
    }
}
