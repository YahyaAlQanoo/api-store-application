<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator($request->all(),[
            'email' => ['required','email','exists:users,email'],
            'password' => ['required','string','min:6'],
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', $request->email)->first();
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken('User-Token');
                $user->token = $token->accessToken;
                return new Response(['status'=>true, 'message' => 'Logged in successfully', 'data' => $user], Response::HTTP_OK);
            }else {
                return new Response(['status'=>false, 'message' => 'Wrong password'], Response::HTTP_BAD_REQUEST);
            }
        }else {
            return new Response(['status'=>false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

 
    public function register(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => ['required','string','min:3','max:20'],
            'phone' => ['required','string','size:13'],
            'email' => ['required','email','unique:users,email'],
            'country' => ['required'],
            'password' => ['required', Password::min(3)->letters()->symbols()->mixedCase()->uncompromised()],
            'image' => ['image','mimes:jpg,png','max:1024'],
        ]);

        if (! $validator->fails()) {
            $user = new User();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->country = $request->country;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image_name = time() . '_image_' . $user->name . '.' . $file->getClientOriginalExtension();
                $file->storeAs("user", $image_name , ['disk' => 'public']);
                $user->image = "users/" . $image_name;
            }

            $saved = $user->save();
            return new Response(['ststus'=>$saved, 'message'=>$saved ? 'Registered Successfuly' : 'Register Failed'], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

        }else {
            return new Response(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator($request->all(),[
            'email' => ['required','email','exists:users,email'],
        ]);

        if (! $validator->fails()) {
            $user = User::where('email','=',$request->email);
            // $user->
            $saved = $user->save();
            Mail::to($user)->send(new AdminResetPasswordEmail());
            return new Response(['ststus'=>$saved, 'message'=>$saved ? 'Send code to Email Successfuly' : 'Send code to Email Failed'], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else {
            return new Response(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }


    }

    public function resetPassword(Request $request) {}

    public function changePassword(Request $request)
    {
        /**
         * 1- must send a token in header
         * 2- must send following data in body :
         *      1- old-password
         *      1- new-password
         *      1- new-password-confirmation
         */
        
        $validator = Validator($request->all(),[
            'current_password' => 'required|current_password:web-api',
            'new_password' => ['required','confirmed',Password::min(3)->letters()->symbols()->mixedCase()->uncompromised()], 
            'new_password_confirmation' => 'required',
        ]);

        if (! $validator->fails()) {
            $user = $request->user('web-api');
            $user->password = Hash::make($request->new_password);
            $saved = $user->save();
            return new Response(['ststus'=>$saved, 'message'=>$saved ? 'Password Changed' : 'Change Password Failed'], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else {
            return new Response(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator($request->all(),[
    //         'email' => ['required','email','max:255'],
    //         'password' => ['required','string','min:6'],
    //     ]);

    //     if (!$validator->fails()) {
    //         $user = User::where('email', $request->email)->first();
    //         if(Hash::check($request->password, $user->password)) {
    //             $token = $user->createToken('User-Token');
    //             return new Response(['status'=>true, 'message' => 'Logged in successfully', 'data' => $token], Response::HTTP_OK);
    //         }else {
    //             return new Response(['status'=>false, 'message' => 'Wrong password'], Response::HTTP_BAD_REQUEST);
    //         }
    //     }else {
    //         return new Response(['status'=>false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    //     }

    //     // $user = User::where('email', $request->email)->first();
    //     // if($user && Hash::check($request->password, $user->password)) {
    //     //     $device_name = $request->post('device_name', $request->userAgent());
    //     //     $token = $user->createToken($device_name );
    //     //     return [
    //     //         'code' => 1,
    //     //         'token' => $token->plainTextToken,
    //     //         'user' => $user,
    //     //     ];
    //     // }

    //     return [
    //         'code' => 0,
    //         'message' => 'Invalid Credentials' ,
    //     ];
    // }

    public function logout(Request $request)
    {
        // return new Response(['status'=>Auth::user()]);
        $user = $request->user('web-api');
        $revoked = $user->token()->revoke();
        return new Response(['ststus'=>$revoked, 'message'=>$revoked ? 'Logout  Successfuly' : 'Logout Failed']);


        // $user = Auth::guard('sanctum')->user();


        // Revoke all token
        // $user->tokens()->delete();

        // if (null === $token) {
        //     $user->currentAccessToken()->delete();
        //     return;
        // }



        // $personalAccessToken = PersonalAccessToken::findToken($token);
        // if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type) {
        //     $personalAccessToken->delete();
        // }

        // $user->tokens()->where('token',$token)->delete();

    }
}










// $validator = Validator($request->all(),[]);

// if (! $validator->fails()) {
    
// }else {
//     return new Response(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
// }

