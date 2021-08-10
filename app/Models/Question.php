<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setTitleAttribute(string $title){
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str::slug($title);
    }

    public function owner(){
        return $this->belongsTo(user::class,'user_id');
    }
    public function getUrlAttribute()
    {
        return "question/{$this->slug}";
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function getAnswerStyleAttribute(){
        if($this->answers_count>0){
            return "Answered";
        }
        return "Not Answered";
    }
    public function vote(int $vote){
        $this->votes()->attach(auth()->id(),['vote'=>$vote]);
        if($vote<0){
            $this->decrement('votes_count');
        }
        else{
            $this->increment('votes_count');
        }
    }

    public function updateVote(int $vote){
        $this->votes()->updateExistingPivot(auth()->id(),['vote'=>$vote]);
        if($vote<0){
            $this->decrement('votes_count');
            $this->decrement('votes_count');
        }
        else{
            $this->increment('votes_count');
            $this->increment('votes_count');
        }
    }
    public function votes(){
        return $this->morphToMany(User::class,'vote')->withTimestamps();
    }

    public function favorites(){
        return $this->belongsToMany(User::class);
    }
    public function getIsFavoriteAttribute(){
        return $this->favorites()->where('user_id',auth()->id())->count() >0;
    }
    public function getFavoriteCountAttribute(){
        return $this->favorites()->count();
    }
}
