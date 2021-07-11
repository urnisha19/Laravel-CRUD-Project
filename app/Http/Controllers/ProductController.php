<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //index
    public function index()
    {
        $products = Product::latest()->paginate(100);
        return view('products.index', compact('products')) ->with('i', (request()->input('page', 1) - 1) * 100);
    }

    //<--------------------------------------------Create-------------------------------------------->
    public function create(){
        return view('products.create');
    }
    //store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_weight' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $input = $request->all();
        if ($image = $request->file('product_image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";
        }
        Product::create($input);//will keep the requested data in the database
        return redirect()->route('products.index')->with('success','Product added successfully.');
    }
    
    //<--------------------------------------------Read-------------------------------------------->
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
    
    //<--------------------------------------------Update-------------------------------------------->
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_weight' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $input = $request->all();
        if ($image = $request->file('product_image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['product_image'] = "$profileImage";
        }else{
            unset($input['product_image']);
        }
        $product->update($input);
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    //<--------------------------------------------Delete-------------------------------------------->
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

}
