<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        $school_id = School::select('id')->inRandomOrder()->first()->id;
        return [
            "name" => $this->faker->name,
            "school_id" => $school_id,
        ];
    }
}
