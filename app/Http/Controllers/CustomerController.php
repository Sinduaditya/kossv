<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('backend.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Customer::create($data);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
