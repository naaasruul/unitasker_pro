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
        Schema::create('group_projects', function (Blueprint $table) {
            $table->id('group_project_id'); // Primary key
            $table->unsignedBigInteger('group_project_course_project_id'); // Foreign key to course project
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('group_project_course_project_id')
                ->references('id') // Assuming the primary key of the course project table is `id`
                ->on('courses') // Replace 'courses' with the actual table name for course projects
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_projects');
    }
};
