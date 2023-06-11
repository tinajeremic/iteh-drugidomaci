<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Writer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
        return [
            'title'=>$this->faker->words(rand(2, 10), true),
            'year'=>$this->faker->year(),     
            'user_id'=>User::factory(),
            'writer_id'=>Writer::factory(),
            
        ];
    }
}
