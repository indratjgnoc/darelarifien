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

            // Tahun akademik
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            // Nama kelas
            $table->string('name', 100);

            // Tingkat kelas
            $table->string('level', 50);

            // Wali kelas
            $table->foreignId('homeroom_teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();

            // Status kelas
            $table->boolean('is_active')
                ->default(true);

            // Urutan tampilan
            $table->integer('sort_order')
                ->default(0);

            // Keterangan
            $table->text('description')
                ->nullable();

            $table->timestamps();

            // Index
            $table->index('name');
            $table->index('level');
            $table->index('is_active');

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
