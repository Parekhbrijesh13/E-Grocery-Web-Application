<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("Admin.categories.index")->with('categories',$categories);
    }

    public function store(CategoryRequest $request){
        $validatedData = $request->validated();

        $img_name = null;
        if ($request->hasFile('category_img')) {
            $img_path = $request->file('category_img');
            $img_name = $img_path->store('Category_imgs','public');
        }

        $category = Category::create([
            "category_name"=> $validatedData["category_name"],
            "slug"=> $validatedData["slug"],
            "emoji"=> $validatedData["emoji"] ?? null,
            "category_img"=> $img_name,
            "description"=> $validatedData["description"] ?? null,
            "status"=> $validatedData["status"],
        ]);

        session()->flash('success', 'Category created successfully!');
        return response()->json(["status"=>"success","message"=> "Category created successfully!"]);

    }

    public function update(CategoryRequest $request, $id){
        $category = Category::findOrFail($id);
        $validatedData = $request->validated();

        $data = [
            "category_name"=> $validatedData["category_name"],
            "slug"=> $validatedData["slug"],
            "emoji"=> $validatedData["emoji"] ?? null,
            "description"=> $validatedData["description"] ?? null,
            "status"=> $validatedData["status"],
        ];

        if ($request->hasFile('category_img')) {
            if ($category->category_img && Storage::disk('public')->exists($category->category_img)) {
                Storage::disk('public')->delete($category->category_img);
            }

            $data["category_img"] = $request->file('category_img')->store('Category_imgs','public');
        }

        $category->update($data);

        session()->flash('success', 'Category updated successfully!');
        return response()->json(["status"=>"success","message"=> "Category updated successfully!"]);
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        session()->flash("success","Category Deleted Successfully");
        return response()->json(["status"=> "success","message"=> "Category Deleted Successfully"]);
    }

}
