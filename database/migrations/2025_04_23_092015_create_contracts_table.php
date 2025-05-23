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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->unique()->nullable()->constrained('proposals');
            $table->foreignId('freelancer_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects', 'id')->cascadeOnDelete();
            $table->unsignedFloat('cost');
            $table->enum('type', ['fixed', 'hourly']);
            $table->date('start_on');
            $table->date('end_on');
            $table->date('completed_on')->nullable();
            $table->unsignedFloat('hours')->nullable()->default(0);
            $table->enum('status', ['active', 'completed', 'terminated']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
