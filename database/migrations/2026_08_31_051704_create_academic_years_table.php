<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();

            $table->string('name', 20);
            // Contoh: 2026/2027

            $table->enum('semester', [
                'ganjil',
                'genap',
            ]);

            $table->boolean('is_active')
                ->default(false);

            $table->boolean('registration_open')
                ->default(false);

            $table->boolean('course_selection_open')
                ->default(false);

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->timestamps();

            $table->index([
                'name',
                'semester',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};