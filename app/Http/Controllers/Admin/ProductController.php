<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->paginate();
        // $products = Product::all();
        // dd($products);
          return response()->view('Admin.Products.index' , ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return response()->view('Admin.Products.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'category_id' =>'exists:categories,id',
            'image'=>'nullable',
        ]);
        // 1 :Eloquent (Model)
        $product = new Product();
        $product->name = $request->input("name");
        $product->Description = $request->input("Description");
        $product->category_id = $request->input("category_id");
 
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $product->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("product", $image_name , ['disk' => 'public']);
            $product->image = "product/" . $image_name;

        }

        $saved = $product->save();
        return redirect()->route('products.index')->with('success', 'Created Product Is Succeffuly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = DB::table('items')
        ->join('products', 'items.product_id', '=', 'products.id')
        ->select('items.*', 'products.name as product_parent_name')
        ->where('product_id','=', $id)
        ->get();
        // dd($products);

        return response()->view('Admin.Products Child.index' , ['products' => $products,'id'=>$id]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $product = Product::findOrFail($id);
            $categories = Category::all();
        return response()->view('Admin.Products.edit', compact('categories','product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'category_id' =>'exists:categories,id',
            'image'=>'nullable',
        ]);
        // 1 :Eloquent (Model)
        $product =Product::findOrFail($id);
        $product->name = $request->input("name");
        $product->Description = $request->input("Description");
        $product->category_id = $request->input("category_id");
 
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $product->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("product", $image_name , ['disk' => 'public']);
            $product->image = "product/" . $image_name;

        }

        $saved = $product->save();
        return redirect()->route('products.index')->with('success', 'Created Product Is Succeffuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Product::destroy($id);
        return redirect()->back();
    }
}
