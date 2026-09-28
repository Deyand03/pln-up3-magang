<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id')->unique()->constrained('internships')->cascadeOnDelete();
            $table->decimal('score_discipline', 5, 2);
            $table->decimal('score_performance', 5, 2);
            $table->decimal('score_attitude', 5, 2);
            $table->decimal('final_score', 5, 2);
            $table->string('grade');
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
