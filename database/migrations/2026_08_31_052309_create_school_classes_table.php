<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->string('name', 100);

            $table->string('level', 20);

            $table->foreignId('homeroom_teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();

            $table->boolean('is_active')
                ->default(true);

            $table->text('description')
                ->nullable();

            $table->timestamps();

            $table->index([
                'academic_year_id',
                'level',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};