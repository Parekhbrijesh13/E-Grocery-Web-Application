<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index(){
        $offers = Offer::orderBy('id', 'desc')->get();
        return view("Admin.offers.index", compact('offers'));
    }

    public function store(OfferRequest $request){
        $validatedData = $request->validated();
        
        $image_name = null;
        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->store('Offer_imgs', 'public');
        }

        Offer::create([
            "title" => $validatedData["title"],
            "description" => $validatedData["description"] ?? null,
            "image" => $image_name,
            "discount_percent" => $validatedData["discount_percent"] ?? null,
            "start_date" => $validatedData["start_date"] ?? null,
            "end_date" => $validatedData["end_date"] ?? null,
            "status" => $validatedData["status"],
        ]);

        session()->flash('success', 'Offer created successfully!');
        return response()->json(["status"=>"success", "message"=> "Offer created successfully!"]);
    }

    public function update(OfferRequest $request, $id){
        $offer = Offer::findOrFail($id);
        $validatedData = $request->validated();

        $data = [
            "title" => $validatedData["title"],
            "description" => $validatedData["description"] ?? null,
            "discount_percent" => $validatedData["discount_percent"] ?? null,
            "start_date" => $validatedData["start_date"] ?? null,
            "end_date" => $validatedData["end_date"] ?? null,
            "status" => $validatedData["status"],
        ];

        if ($request->hasFile('image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $data["image"] = $request->file('image')->store('Offer_imgs', 'public');
        }

        $offer->update($data);

        session()->flash('success', 'Offer updated successfully!');
        return response()->json(["status"=>"success", "message"=> "Offer updated successfully!"]);
    }

    public function delete($id){
        $offer = Offer::findOrFail($id);
        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();
        session()->flash("success", "Offer Deleted Successfully");
        return response()->json(["status"=> "success", "message"=> "Offer Deleted Successfully"]);
    }
}
