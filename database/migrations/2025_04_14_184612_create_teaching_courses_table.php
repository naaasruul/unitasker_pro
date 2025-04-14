<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teaching_courses', function (Blueprint $table) {
            $table->id('teaching_course_id'); // Primary key
            $table->string('lecturer_staffid'); // Lecturer staff ID
            $table->string('course_code'); // Course code
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('lecturer_staffid')
                ->references('lecturer_staffId')
                ->on('lecturers')
                ->onDelete('cascade');

            $table->foreign('course_code')
                ->references('course_code')
                ->on('courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_courses');
    }
};
