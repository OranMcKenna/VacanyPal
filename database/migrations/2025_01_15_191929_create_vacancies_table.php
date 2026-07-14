<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('reference_number')->unique();
            $table->string('job_title');
            $table->string('vacancy_type')->default('Part-Time');
            $table->text('job_description');
            $table->string('company_name');
            $table->foreignId('industry_id')->nullable()->constrained('industries')->onDelete('cascade');
            $table->text('skills_required');
            $table->date('application_open');
            $table->date('application_close');
            $table->longText('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
}
