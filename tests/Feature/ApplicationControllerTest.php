<?php

namespace Tests\Feature;

use App\Enums\Role;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Industry;
use App\Models\Application;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_store_whenAuthenticated_applicationIsCreated(): void
    {
        // Arrange
        $user = User::factory()->create([
            'role' => Role::ADMIN,
        ]);
        $this->actingAs($user);

        $industry = Industry::factory()->create();
        $vacancy = Vacancy::factory()->create(['industry_id' => $industry->id]);

        $applicationData = [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'mobile_number' => fake()->numerify('###########'), // Valid 11-digit number
            'statement' => fake()->paragraph(),
            'cv' => UploadedFile::fake()->create('resume.pdf', 200, 'application/pdf'), // Simulated file
            'vacancy_id' => $vacancy->id,
        ];

        // Act
        $response = $this->post(route('applications.store', $vacancy->id), $applicationData);

        // Assert
        $response->assertSessionHasNoErrors(); // Ensure no validation errors
        $this->assertDatabaseHas('applications', [
            'name' => $applicationData['name'],
            'email' => $applicationData['email'],
            'vacancy_id' => $vacancy->id,
        ]);
    }


    public function test_show_applicationDoesntExist_returnNone(): void
    {
        // Arrange
        $applicationId = 999;

        // Act
        $response = $this->get(route('applications.show', $applicationId));

        // Assert
        $this->assertEquals(0, Application::where('id', $applicationId)->count());
    }
}
