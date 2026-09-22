<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('teacher_class_subject_id')
                ->nullable()
                ->after('id')
                ->constrained('teacher_class_subjects')
                ->nullOnDelete();

            $table->index('teacher_class_subject_id');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropForeign([
                'teacher_class_subject_id',
            ]);

            $table->dropIndex([
                'teacher_class_subject_id',
            ]);

            $table->dropColumn('teacher_class_subject_id');
        });
    }
};