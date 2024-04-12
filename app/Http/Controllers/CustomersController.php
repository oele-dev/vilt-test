<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notice = session('notice');
        session(['notice' => null]);

        return Inertia::render('Customers/Index', [
            'customers' => Customer::query()
                ->paginate()
                ->withQueryString()
                ->through(fn ($customer, $k) => [
                    'index' => $k + 1,
                    'id' => $customer->id,
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                ]),
            'status' => $notice,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Inertia::render('Customers/Create.vue');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [
           'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Customer $customer)
    {
        Request::validate([
            'first_name' => ['required', 'max:50', 'min:2'],
            'last_name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', 'max:50', 'min:2'],
            'phone' => ['required', 'digits:10'],
            'observation' => ['nullable', 'max:500'],
        ]);

        $customer->update(Request::all());

        session(['notice' => 'Customer updated correctly']);

        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
    }
}
