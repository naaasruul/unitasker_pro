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
        Schema::create('group_members', function (Blueprint $table) {
            $table->id('group_member_id'); // Primary key
            $table->unsignedBigInteger('group_member_group_project_id'); // Foreign key to group project
            $table->unsignedBigInteger('group_member_enrollment_student_course_id'); // Foreign key to enrollment student course
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('group_member_group_project_id')
                ->references('group_project_id')
                ->on('group_projects')
                ->onDelete('cascade');

            $table->foreign('group_member_enrollment_student_course_id')
                ->references('enrollment_student_course_id')
                ->on('enrollment_student_courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_members');
    }
};
