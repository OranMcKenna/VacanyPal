<?php

namespace Tests\Unit;

use App\Models\Vacancy;
use App\Models\Application;
use App\Models\Industry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacancyModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_vacancy_belongsTo_industry()
    {
        $industry = Industry::factory()->create();
        $vacancy = Vacancy::factory()->create(['industry_id' => $industry->id]);

        $this->assertInstanceOf(Industry::class, $vacancy->industry);
        $this->assertEquals($industry->id, $vacancy->industry->id);
    }

    public function test_vacancy_hasMany_applications()
    {
        $industry = Industry::factory()->create();
        $vacancy = Vacancy::factory()->create();
        Application::factory()->count(3)->create(['vacancy_id' => $vacancy->id]);

        $this->assertCount(3, $vacancy->applications);
        $this->assertInstanceOf(Application::class, $vacancy->applications->first());
    }
}
