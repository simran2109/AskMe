<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Question $question){
        $question->favorites()->attach(auth()->id());
        return redirect()->back();
    }
    public function destroy(Question $question){
        $question->favorites()->detach(auth()->id());
        return redirect()->back();
    }    
}
