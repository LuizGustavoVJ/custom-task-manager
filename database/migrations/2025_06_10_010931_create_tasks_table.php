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
        Schema::create("tasks", function (Blueprint $table) {
            $table->id();
            $table->foreignId("project_id")->constrained("projects")->onDelete("cascade");
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("status")->default("pending"); // Ex: pending, in_progress, completed
            $table->timestamp("due_date")->nullable();
            $table->foreignId("user_id")->nullable()->constrained("users")->onDelete("set null"); // Responsável pela tarefa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tasks");
    }
};


