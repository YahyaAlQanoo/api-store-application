<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductChild;
use Illuminate\Http\Request;

class ProductChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return response()->view('Admin.Products Child.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'product_id' =>'exists:products,id',
            'price'=>'required',
            'color'=>'required',
            'size'=>'required',
            'image'=>'nullable',
        ]);
        // 1 :Eloquent (Model)
        $product = new ProductChild();
        $product->name = $request->input("name");
        $product->Description = $request->input("Description");
        $product->product_id = $request->input("product_id");
        $product->price = $request->input("price");
        $product->color = $request->input("color");
        $product->size = $request->input("size");
  
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $product->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("product_child", $image_name , ['disk' => 'public']);
            $product->image = "product_child/" . $image_name;

        }

        $saved = $product->save();
        return redirect()->route('products.show',$request->product_id)->with('success', 'Created Product Is Succeffuly.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd(11111111);
        $product = ProductChild::findOrFail($id);
        $products = Product::all();
 
        return response()->view('Admin.Products Child.edit', compact('products','product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'product_id' =>'exists:products,id',
            'price'=>'required|numeric',
            'color'=>'required',
            'size'=>'required',
            'image'=>'nullable',
        ]);
        // 1 :Eloquent (Model)
         $product = ProductChild::findOrFail($id);

        $product->name = $request->input("name");
        $product->Description = $request->input("Description");
        $product->product_id = $request->input("product_id");
        $product->price = $request->input("price");
        $product->color = $request->input("color");
        $product->size = $request->input("size");
  
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $product->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("product_child", $image_name , ['disk' => 'public']);
            $product->image = "product_child/" . $image_name;

        }

        $saved = $product->save();
        return redirect()->route('products.show',$request->product_id)->with('success', 'Update Product Is Succeffuly.');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = ProductChild::destroy($id);
        return redirect()->back();
    }
}
