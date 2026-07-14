<?php

namespace Database\Factories;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    public function definition()
    {
        return [
            'vacancy_id' => Vacancy::inRandomOrder()->first()->id, // Assign to a random vacancy
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile_number' => $this->faker->phoneNumber,
            'statement' => $this->faker->paragraph,
            'cv' => $this->faker->filePath(),
        ];
    }
}
