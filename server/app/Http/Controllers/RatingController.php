<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\User;
use App\Http\Requests\UserRatingPost;

class RatingController extends Controller
{
    public function index(){
        return Rating::all();
    }

    public function show($id){
        return Rating::find($id);
    }

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
