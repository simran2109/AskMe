<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function hasQuestionUpVote(Question $question)
    {
        return auth()->user()->votesQuestions()->where(['vote'=>1,'vote_id'=>$question->id,'vote_type'=>Question::class])->exists();
    }


    public function hasQuestionDownVote(Question $question)
    {
        return auth()->user()->votesQuestions()->where(['vote'=>-1,'vote_id'=>$question->id,'vote_type'=>Question::class])->exists();
    }

    public function hasVoteForQuestion(Question $question){
        return $this->hasQuestionUpVote($question) || $this->hasQuestionDownVote($question);
    }

    public function votesQuestions(){
        return $this->morphedByMany(Question::class,'vote')->withTimestamps();
    }

}
