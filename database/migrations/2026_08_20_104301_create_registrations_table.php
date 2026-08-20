<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->string('registration_number')->unique();

            $table->string('student_name');

            $table->string('gender');

            $table->date('birth_date')->nullable();

            $table->string('birth_place')->nullable();

            $table->text('address')->nullable();

            $table->string('phone');

            $table->string('email')->nullable();

            $table->string('parent_name')->nullable();

            $table->string('parent_phone')->nullable();

            $table->string('school_origin')->nullable();

            $table->string('program')->nullable();

            $table->string('document')->nullable();

            $table->enum('status', [
                'pending',
                'review',
                'accepted',
                'rejected'
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};