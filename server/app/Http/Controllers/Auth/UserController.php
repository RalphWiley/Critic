<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rating;
use JWTAuth;

class UserController extends Controller
{
    
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return User::find($user);
    }

    public function userRatings(Request $request, $id)
    {
    
        $rate = Rating::all();
        
        $userRates = $rate->where('user_id', $id);
       
        return $userRates;
    }

     public function sendRequest(Request $request)
    {
       $user = auth('api')->user();
    
        $email = $request->input('email');
  
       $recipient = User::where('email', $email)->first();
       
       $user->befriend($recipient);
    return $recipient->getFriendRequests();
    }

}