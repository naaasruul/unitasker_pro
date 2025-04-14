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
        Schema::create('course_projects', function (Blueprint $table) {
            $table->id('course_project_id'); // Primary key
            $table->unsignedBigInteger('course_project_teaching_course_id'); // Foreign key to teaching course
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('course_project_teaching_course_id')
                ->references('teaching_course_id')
                ->on('teaching_courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_projects');
    }
};
