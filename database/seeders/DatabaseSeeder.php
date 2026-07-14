<?php

namespace Database\Seeders;

use App\Enums\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            IndustrySeeder::class,
            VacancySeeder::class,
        ]);


        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN
        ]);
        User::create([
            'name' => 'Employer',
            'email' => 'employer@mail.com',
            'password' => Hash::make('password'),
            'role' => Role::EMPLOYER
        ]);
        User::create([
            'name' => 'Guest',
            'email' => 'guest@mail.com',
            'password' => Hash::make('password'),
            'role' => Role::GUEST
        ]);


        // add other default users here

        // call other seeders here

    }
}
