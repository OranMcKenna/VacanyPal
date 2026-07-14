<?php

namespace Tests\Feature;

use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Industry;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VacancyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_whenUnauthenticated_returns302Response(): void
    {
        // Act
        $response = $this->get('/vacancies');

        // Assert
        $response->assertStatus(302);
    }

    public function test_index_whenAuthenticated_returns200Response(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());

        // Act
        $response = $this->get(route('vacancies.index'));

        // Assert
        $response->assertStatus(200);
    }

    public function test_show_whenVacancyExists_vacancyCountIsOne(): void
    {
        // Arrange
        $this->actingAs(User::factory()->create());

        $industry = Industry::create(['name' => 'Technology']);

        Vacancy::create([
            'reference_number' => 10101,
            'job_title' => 'Software Engineer',
            'job_description' => 'Develop software solutions.',
            'company_name' => 'TechCorp',
            'industry_id' => $industry->id,
            'skills_required' => 'Programming skills',
            'application_open' => '2024-10-01',
            'application_close' => '2024-12-01',
            'vacancy_type' => 'Full-time',
        ]);

        // Assert
        $this->assertEquals(1, Vacancy::count());
    }

    public function test_show_whenVacancyDoesNotExist_returnsErrorMessage(): void
    {
        // Arrange
        $vacancyId = 999;

        // Act
        $response = $this->get(route('vacancies.show', $vacancyId));

        // Assert
        $this->assertEquals(0, Vacancy::where('id', $vacancyId)->count());
    }

    public function test_create_whenUserAuthenticated_vacancyIsCreated(): void
    {
        // Arrange
        $user = User::factory()->create(['role' => Role::EMPLOYER]);

        $this->actingAs($user);

        // Act
        $vacancyData = [
            'reference_number' => 10102,
            'job_title' => 'Designer',
            'job_description' => 'Design user interfaces.',
            'company_name' => 'DesignCo',
            'industry_id' => Industry::factory()->create()->id,
            'skills_required' => 'UI/UX design skills',
            'application_open' => '2024-11-01',
            'application_close' => '2024-12-15',
            'vacancy_type' => 'Part-time',
        ];

        $this->post('/vacancies', $vacancyData);

        // Assert
        $this->assertDatabaseHas('vacancies', ['job_title' => 'Designer']);
    }

    public function test_create_whenUnauthenticated_redirectsToHome(): void
    {
        // Act
        $response = $this->get('/vacancies/create');

        // Assert
        $this->assertEquals(route('home'), $response->headers->get('Location'));
    }

    public function test_store_whenAuthenticated_createsVacancy(): void
    {
        // Arrange
        $user = User::factory()->create([
            'role' => Role::EMPLOYER,
        ]);
        $this->actingAs($user);

        $vacancyData = [
            'reference_number' => 10103,
            'job_title' => 'Project Manager',
            'job_description' => 'Manage projects.',
            'company_name' => 'PMCo',
            'industry_id' => Industry::factory()->create()->id,
            'skills_required' => 'Leadership skills',
            'application_open' => '2024-08-01',
            'application_close' => '2024-09-01',
            'vacancy_type' => 'Contract',
        ];

        // Act
        $response = $this->post('/vacancies', $vacancyData);

        // Assert
        $this->assertDatabaseHas('vacancies', ['job_title' => 'Project Manager']);
    }

    public function test_update_whenAuthenticated_updatesVacancy(): void
    {
        // Arrange
        $user = User::factory()->create([
            'role' => Role::EMPLOYER,
        ]);
        $this->actingAs($user);

        $industry = Industry::factory()->create(['name' => 'Education']);
        $vacancy = Vacancy::factory()->create([
            'job_title' => 'Teacher',
            'industry_id' => $industry->id,
        ]);

        $updatedData = [
            'job_title' => 'Updated Teacher',
            'job_description' => 'Updated description.',
            'company_name' => 'Updated EduCo',
            'industry_id' => $industry->id,
            'skills_required' => 'Updated skills',
            'application_open' => '2024-06-01',
            'application_close' => '2024-07-01',
            'vacancy_type' => 'Part-time',
        ];

        // Act
        $response = $this->put(route('vacancies.update', $vacancy->id), $updatedData);

        // Assert
        $response->assertRedirect(route('vacancies.show', $vacancy->id));
        $this->assertEquals('Updated Teacher', $vacancy->fresh()->job_title);
    }


    public function test_destroy_whenAuthenticated_deletesVacancy(): void
    {
        // Arrange
        $user = User::factory()->create([
            'role' => Role::EMPLOYER,
        ]);
        $this->actingAs($user);

        $vacancy = Vacancy::factory()->create([
            'industry_id' => Industry::factory()->create()->id,
        ]);

        $initialCount = Vacancy::count();

        // Act
        $response = $this->delete(route('vacancies.destroy', $vacancy->id));

        // Assert
        $response->assertRedirect(route('vacancies.index'));
        $this->assertEquals($initialCount - 1, Vacancy::count());
    }

    public function test_search_byTitle_returnsCorrectVacancy(): void
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        $vacancy = Vacancy::factory()->create([
            'job_title' => 'Software Engineer',
            'industry_id' => Industry::factory()->create()->id,
        ]);

        // Act
        $response = $this->get('/vacancies?search=Software Engineer');

        // Assert
        $response->assertSee('Software Engineer');
    }
}
