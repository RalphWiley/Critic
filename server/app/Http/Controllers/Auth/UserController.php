<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rating;

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
}
