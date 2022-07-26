<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition()
    {
        $school = School::select('id')->inRandomOrder()->first();
        if (! $school) {
            $school = School::factory()->create();
        }
        $school_id = $school->id;
        return [
            "name" => $this->faker->name,
            "school_id" => $school_id,
        ];
    }
}
