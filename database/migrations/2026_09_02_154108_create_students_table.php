<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Akun login siswa
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();

            // Identitas siswa
            $table->string('nis', 50)->unique();
            $table->string('nisn', 50)->nullable()->unique();

            $table->string('name');

            $table->string('gender', 20)->nullable();

            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();

            $table->text('address')->nullable();

            $table->string('phone', 30)->nullable();

            // Data orang tua / wali
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_name')->nullable();

            $table->string('parent_phone', 30)->nullable();

            // Kelas siswa pada tahun ajaran tertentu
            $table->foreignId('academic_year_id')
                ->nullable()
                ->constrained('academic_years')
                ->nullOnDelete();

            $table->foreignId('school_class_id')
                ->nullable()
                ->constrained('school_classes')
                ->nullOnDelete();

            $table->string('photo')->nullable();

            $table->boolean('is_active')->default(true);

            $table->text('description')->nullable();

            $table->timestamps();

            $table->index([
                'academic_year_id',
                'school_class_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};