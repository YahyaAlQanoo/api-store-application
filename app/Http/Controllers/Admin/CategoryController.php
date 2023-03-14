<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Category::all();

         return response()->view('Admin.Categores.index' , ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('Admin.Categores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'image'=>'nullable',
        ]);
        // 1 :Eloquent (Model)
        $category = new Category();
        $category->name = $request->input("name");
        $category->Description = $request->input("Description");

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $category->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("category", $image_name , ['disk' => 'public']);
            $category->image = "category/" . $image_name;

        }

        // $meating->image = $request->input("image");
        $saved = $category->save();
        return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);
        return response()->view('Admin.Categores.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|string|min:4|max:20',
            'Description'=>'required',
            'image'=>'nullable',
        ]);

        // $user = User::find($id);
        $category = Category::findOrFail($id);
        $category->name = $request->input("name");
        $category->Description = $request->input("Description");

        
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_name = time() . '_image_' . $category->name . '.' . $file->getClientOriginalExtension();
            $file->storeAs("category", $image_name , ['disk' => 'public']);
            $category->image = "category/" . $image_name;

        }


        $saved = $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Category::destroy($id);

        return redirect()->back();

    }
}
