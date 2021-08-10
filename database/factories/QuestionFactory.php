<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>rtrim($this->faker->sentence(rand(5,10)),'.'),
            'body'=>$this->faker->paragraphs(rand(1,7),true),
            'views_count'=>rand(0,10),            
            'answers_count'=>rand(0,10),            
            'user_id'=>User::pluck('id')->random(),            
            'votes_count'=>rand(0,10),            
        ];
    }
}
