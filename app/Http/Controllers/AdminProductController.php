<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{

    public function index()
    {
        $type = 'Men';
        $categories = Category::all()->where('type', 'Men');
        // $products = Product::all();
        $products = Product::query()
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*')
            ->where('categories.type', $type)
            ->get();

        return view('admin.product', compact('products', 'categories', 'type'));

        // return view('admin.product', compact('products','categories'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            "category_id" => "required|numeric",
            "name" => "required",
            'size' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();

        // dd($data['size']);
        $formData = [];
        $formData['size'] = $data['size'];
        $formData['name'] = $data['name'];
        $formData['price'] = $data['price'];
        $formData['description'] = $data['description'];
        $formData['category_id'] = $data['category_id'];

        $category = Category::find($request->category_id);
        $type = $category->type;
        Product::create($formData);
        $product = Product::orderByDesc('created_at')->skip(0)->take(1)->get(); //Product::all()->last();
        $categories = Category::all()->where('type', $type);


        return view('admin.productedit', compact('categories', 'product'));

        // return back();
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $formFields = $request->validate([
            "category_id" => "required|numeric",
            "name" => "required",
            "size" => "required",
            'price' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();
        $product->update([
            "category_id" => $data['category_id'],
            "name" => $data['name'],
            "size" => $data['size'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);
        return back();
    }


    public function show($id)
    {
        $product = Product::find($id);
        // dd($product);
        // $categories = Category::all();
        $category = Category::find($product->category_id);
        // $products = Product::all();
        $type = $category->type;
        // dd($type);
        $categories = Category::all()->where('type', $type);

        // $products = Product::all();
        // $products = Product::query()
        //     ->join('categories', 'products.category_id', '=', 'categories.id')
        //     ->select('products.*')
        //     ->where('categories.type', $type)
        //     ->get();

        return view('admin.productedit', compact('categories', 'product'));

        // return view('admin.product', compact('products', 'categories', 'product'));

    }


    public function image(Request $request)
    {
        $formFields = $request->validate([
            "product_id" => "required|numeric",
            "image" => "required",
        ]);
        if ($request->hasFile('image')) {

            $file_url = $formFields['image'];
            $input = time() . '.' . $file_url->getClientOriginalExtension();
            $destinationPath = 'storage/product';
            $file_url->move($destinationPath, $input);
            $data['image'] = $input;
            Image::create([
                "product_id" => $formFields["product_id"],
                "image" => $input,
            ]);
        }
        return back();
    }



    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }
    public function deleteImage($id)
    {
        Image::destroy($id);
        return back();
    }


}
