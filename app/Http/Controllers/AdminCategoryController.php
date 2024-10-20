<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        // $products = Product::all();
        return view('admin.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            "name" => "required|max:255",
            "type" => "required",
            'image' => 'required',
        ]);

        $data = $request->all();
        $file_url = $data['image'];
        $input = time() . '.' . $file_url->getClientOriginalExtension();
        $destinationPath = 'storage/product';
        $file_url->move($destinationPath, $input);
        $formFields['image'] = $input;
        Category::create($formFields);
        return back();
    }


    public function show($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('admin.index', compact('category', 'categories'));

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $category = Category::find($id);

        $formFields = $request->validate([
            "name" => "required|max:255",
            "type" => "required",
        ]);

        $data = $request->all();
        $input = $category->image;
        if ($request->hasFile('image')) {
            $img = $data['image'];
            Storage::delete('storage/product/' . $category->image);
            $input = time() . '.' . $img->getClientOriginalExtension();
            $destinationPath = 'storage/product';
            $img->move($destinationPath, $input);
            $category->image = $input;
        }
        // $formFields['image']=$input;
        $category->name = $formFields['name'];
        $category->type = $formFields['type'];
        $category->save();
        return back();
    }



    public function delete($id)
    {
        Category::destroy($id);
        return back();
    }

}
