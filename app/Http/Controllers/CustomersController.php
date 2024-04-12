<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
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
                ->filter(Request::get('search'))
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
            'search' => Request::get('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $validated = Request::validate([
            'first_name' => ['required', 'max:50', 'min:2'],
            'last_name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', Rule::unique('customers', 'email')],
            'phone' => ['required', 'numeric', 'digits_between:5,10'],
            'observation' => ['nullable', 'max:500'],
         ]);

        Customer::create($validated);

        session(['notice' => 'Customer created correctly']);

        return Redirect::route('customers.index');
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
        $validated = Request::validate([
             'first_name' => ['required', 'max:50', 'min:2'],
             'last_name' => ['required', 'max:50', 'min:2'],
             'email' => ['required', Rule::unique('customers', 'email')->ignore($customer->id)],
             'phone' => ['required', 'numeric', 'digits_between:5,10'],
             'observation' => ['nullable', 'max:500'],
         ]);

        $customer->update($validated);

        session(['notice' => 'Customer updated correctly']);

        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        session(['notice' => 'Customer deleted correctly']);

        return Redirect::route('customers.index');
    }
}
