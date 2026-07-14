<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Vacancy;
use App\Models\Industry;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VacancyServiceIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_createVacancy_validInput_returnsVacancy(): void
    {
        // Arrange
        $model = Vacancy::factory()->make([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $vacancy = Vacancy::create($model->toArray());

        // Assert
        $this->assertEquals($vacancy->job_title, $model->job_title);
    }

    public function test_findVacancies_whenNoVacancies_returnsNone(): void
    {
        // Arrange
        Vacancy::query()->delete();

        // Act
        $vacancies = Vacancy::all();

        // Assert
        $this->assertEquals(0, $vacancies->count());
    }

    public function test_findVacancies_whenOneVacancy_returnsOne(): void
    {
        // Arrange
        Vacancy::factory()->create([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $vacancies = Vacancy::all();

        // Assert
        $this->assertEquals(1, $vacancies->count());
    }

    public function test_findVacancy_whenVacancyExists_returnsVacancy(): void
    {
        // Arrange
        $model = Vacancy::factory()->make([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $created = Vacancy::create($model->toArray());
        $vacancy = Vacancy::find($created->id);

        // Assert
        $this->assertEquals($vacancy->job_title, $model->job_title);
        $this->assertEquals($vacancy->industry_id, $model->industry_id);
        $this->assertEquals($vacancy->job_description, $model->job_description);
        $this->assertEquals($vacancy->vacancy_type, $model->vacancy_type);
    }

    public function test_updateVacancy_whenVacancyExists_updatesVacancy(): void
    {
        // Arrange
        $vacancy = Vacancy::factory()->create([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        $updatedData = [
            'job_title' => 'Updated Title',
            'job_description' => 'Updated description',
            'vacancy_type' => 'Part-time',
        ];

        // Act
        $vacancy->update($updatedData);

        // Assert
        $this->assertEquals($vacancy->job_title, $updatedData['job_title']);
        $this->assertEquals($vacancy->job_description, $updatedData['job_description']);
        $this->assertEquals($vacancy->vacancy_type, $updatedData['vacancy_type']);
    }

    public function test_deleteVacancy_whenVacancyExists_deletesVacancy(): void
    {
        // Arrange
        $vacancy = Vacancy::factory()->create([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $vacancyId = $vacancy->id;
        $vacancy->delete();

        // Assert
        $this->assertNull(Vacancy::find($vacancyId));
    }

    public function test_findAllVacancies_whenVacanciesExist_returnsVacancies(): void
    {
        // Arrange
        Vacancy::factory()->count(3)->create([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $vacancies = Vacancy::all();

        // Assert
        $this->assertEquals(3, $vacancies->count());
    }
}
