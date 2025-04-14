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
        Schema::create('group_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade'); // Link to the group
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // User who created the task
            $table->string('name'); // Task name
            $table->text('description')->nullable(); // Task description
            $table->boolean('is_completed')->default(false); // Completion status
            
            $table->json('required_skills')->nullable(); // Add required_skills column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_tasks');
    }
};
