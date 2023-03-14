<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = DB::table('orders')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name as user_name')
        ->paginate();
        // $products = Product::all();
        // dd($orders);
        return response()->view('Admin.Orders.index' , ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders_item = DB::table('orders_items')
        ->where('order_id','=', $id)
        ->get();
        // dd($products);

        return response()->view('Admin.Orders.show' , ['orders_item' => $orders_item,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        return response()->view('Admin.Orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'=>'required',
        ]);
        // 1 :Eloquent (Model)
        $order =Order::findOrFail($id);
        $order->status = $request->input("status");

        $saved = $order->save();
        return redirect()->route('orders.index')->with('success', 'Change Status Order Is Successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Order::destroy($id);
        return redirect()->back();
    }
}
