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
        Schema::create('task_groups', function (Blueprint $table) {
            $table->id('task_group_id'); // Primary key
            $table->unsignedBigInteger('task_group_course_project_id'); // Foreign key to course project
            $table->unsignedBigInteger('task_group_group_member_id'); // Foreign key to group member
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('task_group_course_project_id')
                ->references('group_project_id') // Assuming this references the `group_projects` table
                ->on('group_projects')
                ->onDelete('cascade');

            $table->foreign('task_group_group_member_id')
                ->references('group_member_id') // Assuming this references the `group_members` table
                ->on('group_members')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_groups');
    }
};
