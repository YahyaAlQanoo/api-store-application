<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Points;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();
 
        foreach ($users as $item) {
            $points = DB::table('points')
            ->where('user_id', $item->id )
            ->where('status', 1 )
            ->sum('total');

            $item->points = $points;
        }

        
  

        // $points = DB::table('points')
        // ->where('user_id', $user->id )
        // ->where('status', 1 )
        // ->sum('total');

        return response()->view('Admin.Users.index' , ['users' => $users]);

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
        $points = Points::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(7);
        // dd($points);
        return response()->view('Admin.Users.show' , ['points' => $points]);

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
        $deleted = User::destroy($id);
        return redirect()->back();
    }
}
