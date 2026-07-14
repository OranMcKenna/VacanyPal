<?php

namespace Tests\Unit;

use App\Enums\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseUnitTest extends TestCase
{
    use RefreshDatabase; // Add this trait to refresh the database for each test

    public function test_role_enum(): void
    {
        //Arrange
        $admin = Role::ADMIN;
        $director = Role::EMPLOYER;
        $guest = Role::GUEST;

        //Assert
        $this->assertEquals(Role::ADMIN, $admin);
        $this->assertEquals(Role::EMPLOYER, $director);
        $this->assertEquals(Role::GUEST, $guest);
    }

    public function test_role_enum_options(): void
    {
        //Act
        $options = Role::options();

        //Assert
        $this->assertIsArray($options);
        $this->assertCount(3, array_count_values($options));
    }
}
