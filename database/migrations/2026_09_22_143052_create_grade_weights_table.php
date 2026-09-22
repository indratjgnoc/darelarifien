<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grade_weights', function (Blueprint $table) {
            $table->id();

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->enum('assessment_type', [
                'Tugas',
                'Kuis',
                'Praktik',
                'UTS',
                'UAS',
                'Lainnya',
            ]);

            $table->decimal('weight', 5, 2);

            $table->timestamps();

            $table->unique([
                'academic_year_id',
                'assessment_type',
            ]);
        });

        /*
         * Buat bobot default untuk setiap tahun akademik
         * yang sudah ada.
         */
        $academicYears = DB::table('academic_years')
            ->pluck('id');

        foreach ($academicYears as $academicYearId) {
            DB::table('grade_weights')->insert([
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'Tugas',
                    'weight' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'Kuis',
                    'weight' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'Praktik',
                    'weight' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'UTS',
                    'weight' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'UAS',
                    'weight' => 30,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'academic_year_id' => $academicYearId,
                    'assessment_type' => 'Lainnya',
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('grade_weights');
    }
};