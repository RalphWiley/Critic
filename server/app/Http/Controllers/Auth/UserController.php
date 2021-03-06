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

    // Friends

     public function sendRequest(Request $request)
    {
       $user = auth('api')->user();
    
        $email = $request->input('email');
  
       $recipient = User::where('email', $email)->first();
       
       $user->befriend($recipient);

       return response()->json(['recipient' => $recipient, 'sender' => $user]);
    }

    public function viewRequests(Request $request, $id)
    {
        $recipient = User::find($id);
        return $recipient->getPendingFriendships();
    }

    public function acceptRequest(User $user)
    {
        $recipient = Friendship::all()->where('recipient_id', $user->id)->first();
       
        $sender = $recipient->sender;

        $user->acceptFriendRequest($sender);
 
    }
}