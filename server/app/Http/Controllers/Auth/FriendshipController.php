<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Friendship;
use App\Rating;
use JWTAuth;


class FriendshipController extends Controller
{
    
    public function index()
    {
        return Friendship::all();
    }

    public function showFriends(User $user)
    {
        // grabs all friends
        $myFriends = User::all();
        
        foreach($myFriends as $bros){
            
            // grab friendships by user id -> SUCCESS
            $friends = Friendship::all()->where('user_id', $bros['id']);
            
            foreach($friends as $dudes){
                $names[] = User::all()->where('id', $dudes['recipient_id'])->values();
            }
           
           
            return $names;
    
        }
   
    }

    public function getFriendRatings(User $user)
    {
        $sender = Friendship::all()
                        ->where('sender_id', $user->id)->toArray();
        $recipient = Friendship::all()
                        ->where('recipient_id', $user->id)->toArray();
                        
        $friends = array_merge($sender, $recipient);
        return $friends;
    }

    // public function userRatings(Request $request, $id)
    // {
    
    //     $rate = Rating::all();
        
    //     $userRates = $rate->where('user_id', $id);
       
    //     return $userRates;
    // }

    // // Friends

    //  public function sendRequest(Request $request)
    // {
    //    $user = auth('api')->user();
    
    //     $email = $request->input('email');
  
    //    $recipient = User::where('email', $email)->first();
       
    //    $user->befriend($recipient);

    //    return response()->json(['recipient' => $recipient, 'sender' => $user]);
    // }

    // public function viewRequests(Request $request, $id)
    // {
    //     $recipient = User::find($id);
    //     return $recipient->getPendingFriendships();
    // }

    // public function acceptRequest(User $user)
    // {
    //     $recipient = Friendship::all()->where('recipient_id', $user->id)->first();
       
    //     $sender = $recipient->sender;

    //     $user->acceptFriendRequest($sender);
 
    // }
}