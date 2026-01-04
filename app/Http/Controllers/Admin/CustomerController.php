<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'user')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);
        $customer->load('orders');
        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
    }
}
