<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Dotenv\Validator;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user('web-api');
        if(!$user) {
            return  [
                'ststus'=>false,
                'message' => 'the user not found'
            ];
        }
        $profile = User::findOrFail($user->id);

        return  [
             'user' => $profile
        ];
        
    }
 
    public function update(Request $request)
    {
        $user = $request->user('web-api');
        if(!$user) {
            return  [
                'ststus'=>false,
                'message' => 'the user not found'
            ];
        }
         $id = $user->id;


        $validator = Validator($request->all(), [
            'name' => ['required','string','min:3','max:20'],
            'phone' => ['required','string','size:13'],
            'email' => 'required|email|unique:users,email,'.$id,

             'country' => ['required'],
            'image' => ['image','mimes:jpg,png','max:1024'],
        ]);

        
        if (!$validator->fails()) {
 
            $user = User::findOrFail($id);

            $destination=public_path("storage\\". $user->image);


            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->country = $request->country;
            $user->email = $request->email;
 
            if ($request->hasFile('image')) {
                if(File::exists($destination)){
                    File::delete($destination);
                }
    
                $file = $request->file('image');
                $image_name = time() . '_image_' . $user->name . '.' . $file->getClientOriginalExtension();
                $file->storeAs("user", $image_name , ['disk' => 'public']);
                $user->image = "user/" . $image_name;
            }

            $saved = $user->save();
            return new Response(['ststus'=>$saved, 'message'=>$saved ? 'Updated Profile Successfuly' : 'Updated Profile Failed'], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        }else {
            // return 11;
             return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    
}
