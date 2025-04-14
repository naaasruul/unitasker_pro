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
        Schema::create('enrollment_student_courses', function (Blueprint $table) {
            $table->id('enrollment_student_course_id'); // Primary key
            $table->string('student_matric_number'); // Student matriculation number
            $table->string('course_code'); // Course code
            $table->timestamps();

            // Add foreign key constraints if needed
            $table->foreign('student_matric_number')
                ->references('student_matric_number')
                ->on('students')
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
        Schema::dropIfExists('enrollment_student_courses');
    }
};
