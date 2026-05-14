<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view("Admin.coupons.index", compact('coupons'));
    }

    public function store(CouponRequest $request){
        $validatedData = $request->validated();
        
        Coupon::create($validatedData);

        session()->flash('success', 'Coupon created successfully!');
        return response()->json(["status"=>"success", "message"=> "Coupon created successfully!"]);
    }

    public function update(CouponRequest $request, $id){
        $coupon = Coupon::findOrFail($id);
        $validatedData = $request->validated();

        $coupon->update($validatedData);

        session()->flash('success', 'Coupon updated successfully!');
        return response()->json(["status"=>"success", "message"=> "Coupon updated successfully!"]);
    }

    public function delete($id){
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        session()->flash("success", "Coupon Deleted Successfully");
        return response()->json(["status"=> "success", "message"=> "Coupon Deleted Successfully"]);
    }
}
