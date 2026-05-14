<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::orderBy('id', 'desc')->get();
        return view("Admin.banners.index", compact('banners'));
    }

    public function store(BannerRequest $request){
        $validatedData = $request->validated();
        
        $image_name = null;
        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->store('Banner_imgs', 'public');
        }

        Banner::create([
            "title" => $validatedData["title"],
            "image" => $image_name,
            "link" => $validatedData["link"] ?? null,
            "position" => $validatedData["position"],
            "status" => $validatedData["status"],
        ]);

        session()->flash('success', 'Banner created successfully!');
        return response()->json(["status"=>"success", "message"=> "Banner created successfully!"]);
    }

    public function update(BannerRequest $request, $id){
        $banner = Banner::findOrFail($id);
        $validatedData = $request->validated();

        $data = [
            "title" => $validatedData["title"],
            "link" => $validatedData["link"] ?? null,
            "position" => $validatedData["position"],
            "status" => $validatedData["status"],
        ];

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data["image"] = $request->file('image')->store('Banner_imgs', 'public');
        }

        $banner->update($data);

        session()->flash('success', 'Banner updated successfully!');
        return response()->json(["status"=>"success", "message"=> "Banner updated successfully!"]);
    }

    public function delete($id){
        $banner = Banner::findOrFail($id);
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        session()->flash("success", "Banner Deleted Successfully");
        return response()->json(["status"=> "success", "message"=> "Banner Deleted Successfully"]);
    }
}
