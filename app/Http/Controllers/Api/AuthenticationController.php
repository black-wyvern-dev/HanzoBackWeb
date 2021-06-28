<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => 0,
            'role' => 2,
        ]);
        $token = $user->createToken('TutsForWeb')->accessToken;
        return response()->json(['token' => $token], 200);
    }
    /**
    * Handles Login Request
    *
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            $user = Auth::user();
            $user->fcm_token = $request->token;
            $user->save();
            $parent_id = Auth::user()->parent_id;
            return response()->json([
                'auth'=>Auth::user(),
                'token'=>$token
            ], 200);
        } 
        else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
       
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json(['message' => 'You have been successfully logged out!'], 200);
    }

    public function changeProfile(Request $request) {
        $user = Auth::user();
        if($user) {
            $user->first_name = $request['firstName'];
            $user->last_name = $request['lastName'];
            $user->email = $request['email'];
            if($request['avatar'] != "")
                $user->avatar = $request['avatar'];
            $user->save();
            return response()->json(
                $user
            , 200);
        }
        else {
            return response()->json(['error' => 'No User Found'], 401);
        }
        
    }

    public function avatarUpload(Request $request) {
        $file = $request->file('avatar');
        if($file)
        {
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs("/public/Avatar", $filename);
            return response('http://192.168.104.59:8000/storage/Avatar/'.$filename);
        }
        return response('failed');
    }

    public function changePassword(Request $request) {
        $user = Auth::user();
        if($user) {
            $user->password = bcrypt($request['newPassword']);
            $user->save();
            return response()->json(
                $user
            , 200);
        }
        else {
            return response()->json(['error' => 'No User Found'], 401);
        }
        
    }
}
