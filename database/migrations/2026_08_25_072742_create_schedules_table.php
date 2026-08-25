<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {

            $table->id();

            // Guru yang mengajar
            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

            // Informasi pembelajaran
            $table->string('subject');
            $table->string('class_name');

            // Jadwal
            $table->enum('day', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu',
            ]);

            $table->time('start_time');
            $table->time('end_time');

            // Ruangan
            $table->string('room')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};