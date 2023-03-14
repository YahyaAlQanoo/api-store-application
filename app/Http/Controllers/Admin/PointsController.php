<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = DB::table('users')
        // ->Join('points', 'points.user_id', '=', 'users.id')->distinct()->pluck('user_id');

        // dd($users);

        // $data = DB::table('users')
        // ->Join('points', 'points.user_id', '=', 'users.id')
        // ->select('users.*')
        // ->distinct()->pluck('id');

//         $users = DB::table('points')
//         ->Join('users', 'points.user_id', '=', 'users.id')->get();
// $users_points = [];
// foreach ($users as $user) {
//     if($user->status == 1)
//     dd($user);
// }
        // $points = DB::table('points')
        // ->where('user_id', 4 )
        // ->where('status', 1 )
        // ->sum('total');
















        //     dd($users);
        
        // foreach ($users as $item) {
        //      $point = DB::table('points')
        //     ->Join('users', 'points.user_id', '=', 'users.id')
        //     ->where('status', 1 )
        //     ->where('user_id', $item )
        //         ->sum('total');
        //     // $->point = $point;
        //     dd($item->point);

        // }


        
        // ->where('status', 1 )
                // ->sum('total');
        // $users = User::all();
        // $products = Product::all();
        // dd($users);
        // return response()->view('Admin.Orders.index' , ['orders' => $orders]);



        // $points = DB::table('points')
        // ->Join('users', 'points.user_id', '=', 'users.id')
        // ->where('status', 1 )
        //         ->sum('total');
        // // ->select('orders.*', 'users.name as user_name')
        // // ->get();
        // // $products = Product::all();
        // dd($points);
        // return response()->view('Admin.Orders.index' , ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $order = Order::findOrFail($id);
        return response()->view('Admin.Orders.map' , ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
