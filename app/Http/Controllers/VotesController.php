<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function voteQuestion(Question $question,int $vote){
        if(auth()->user()->hasVoteForQuestion($question)){
            if(($vote==1 && ! auth()->user()->hasQuestionUpVote($question))
                ||
                ($vote==-1 && ! auth()->user()->hasQuestionDownVote($question))
            ){
                $question->updateVote($vote);
            }
        }else{
            $question->vote($vote);
        }
        return redirect()->back();
    }
}