<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industry;

class IndustrySeeder extends Seeder
{
    public function run()
    {
        Industry::insert([
            ['name' => 'Technology'],
            ['name' => 'Healthcare'],
            ['name' => 'Education'],
            ['name' => 'Finance'],
            ['name' => 'Media'],
            ['name' => 'Entertainment'],
            ['name' => 'Retail'],
            ['name' => 'Tourism'],
        ]);
    }
}
