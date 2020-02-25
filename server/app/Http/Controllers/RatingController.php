<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\User;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function getUserRatings(){
       
       return Auth::user()->ratings;
        
    }
    public function index(){
        return Rating::all();
    }

    public function show($id){
        return Rating::find($id);
    } 

    // public function show($user_id){
    //     $rating = Rating::all()->where('user_id', '=', $user_id);
    //     dd($rating);
    // }   

    public function store(Request $request){
        return Rating::create($request->all());
    }

    public function update(Request $request, $id){
        $rating = Rating::findOrFail($id);
        $rating->update($request->all());

        return $rating;
    }

    public function delete(Request $request, $id){
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return 204;
    }
}
