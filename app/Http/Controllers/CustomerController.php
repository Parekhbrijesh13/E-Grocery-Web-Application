<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('id', 'desc')->get();
        return view("Admin.customers.index", compact('customers'));
    }

    public function store(CustomerRequest $request){
        $validatedData = $request->validated();

        $avatar_name = null;
        if ($request->hasFile('avatar')) {
            $avatar_name = $request->file('avatar')->store('Customer_avatars', 'public');
        }

        Customer::create([
            "name" => $validatedData["name"],
            "email" => $validatedData["email"],
            "phone" => $validatedData["phone"] ?? null,
            "address" => $validatedData["address"] ?? null,
            "status" => $validatedData["status"],
            "avatar" => $avatar_name,
        ]);

        session()->flash('success', 'Customer created successfully!');
        return response()->json(["status"=>"success", "message"=> "Customer created successfully!"]);
    }

    public function update(CustomerRequest $request, $id){
        $customer = Customer::findOrFail($id);
        $validatedData = $request->validated();

        $data = [
            "name" => $validatedData["name"],
            "email" => $validatedData["email"],
            "phone" => $validatedData["phone"] ?? null,
            "address" => $validatedData["address"] ?? null,
            "status" => $validatedData["status"],
        ];

        if ($request->hasFile('avatar')) {
            if ($customer->avatar && Storage::disk('public')->exists($customer->avatar)) {
                Storage::disk('public')->delete($customer->avatar);
            }
            $data["avatar"] = $request->file('avatar')->store('Customer_avatars', 'public');
        }

        $customer->update($data);

        session()->flash('success', 'Customer updated successfully!');
        return response()->json(["status"=>"success", "message"=> "Customer updated successfully!"]);
    }

    public function delete($id){
        $customer = Customer::findOrFail($id);
        if ($customer->avatar && Storage::disk('public')->exists($customer->avatar)) {
            Storage::disk('public')->delete($customer->avatar);
        }
        $customer->delete();
        session()->flash("success", "Customer Deleted Successfully");
        return response()->json(["status"=> "success", "message"=> "Customer Deleted Successfully"]);
    }
}
