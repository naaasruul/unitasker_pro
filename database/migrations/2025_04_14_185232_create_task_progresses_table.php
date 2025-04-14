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
        Schema::create('task_progresses', function (Blueprint $table) {
            $table->id('task_progress_id'); // Primary key
            $table->unsignedBigInteger('task_progress_group_project_id'); // Foreign key to group project
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('task_progress_group_project_id')
                ->references('group_project_id') // Assuming this references the `group_projects` table
                ->on('group_projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_progresses');
    }
};
