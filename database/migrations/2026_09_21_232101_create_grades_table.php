<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('teacher_class_subject_id')
                ->constrained('teacher_class_subjects')
                ->cascadeOnDelete();

            $table->enum('assessment_type', [
                'Tugas',
                'Kuis',
                'Praktik',
                'UTS',
                'UAS',
                'Lainnya',
            ]);

            $table->string('assessment_name', 150);

            $table->decimal('score', 5, 2);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index([
                'student_id',
                'teacher_class_subject_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};