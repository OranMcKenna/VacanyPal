<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use App\Models\Vacancy;
use App\Models\Industry;

class VacancySeeder extends Seeder
{
    public function run()
    {
        // Ensure the industries table has data
        if (Industry::count() === 0) {
            $this->call(IndustrySeeder::class);
        }

        // Create sample vacancies
        $vacancies = Vacancy::factory(230)->create([
            'industry_id' => function () {
                return Industry::inRandomOrder()->first()->id;
            }
        ]);
        foreach ($vacancies as $vacancy) {
            $vacancy->applications()->saveMany(
                Application::factory()->count(fake()->numberBetween(1, 8))->make()
            );
        }
    }
}
